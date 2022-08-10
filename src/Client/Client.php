<?php

namespace Simla\Client;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Simla\Component\Environment;
use Simla\Component\Exception\LocalApiException;
use Simla\Component\Exception\ClientException;
use Simla\Component\Exception\FactoryException;
use Simla\Component\Exception\ValidationException;
use Simla\Interfaces\AppDataInterface;
use Simla\Interfaces\ClientInterface as LocalClientInterface;
use Simla\Interfaces\RequestFactoryInterface;
use Simla\Model\Request\BaseRequest;
use Simla\Model\Response\BaseResponse;
use Simla\Model\Response\ResponseInterface;
use Simla\Traits\ValidatorAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Client
 *
 * @category Client
 * @package  Simla\Client
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Client implements LocalClientInterface
{
    use ValidatorAwareTrait;

    /**
     * @var AppDataInterface $appData
     */
    protected $appData;

    /**
     * @var ClientInterface $httpClient
     * @Assert\NotNull(message="HTTP client should be provided")
     */
    protected $httpClient;

    /**
     * @var RequestFactoryInterface $requestFactory
     * @Assert\NotNull(message="RequestFactoryInterface should be provided")
     */
    protected $requestFactory;

    /**
     * @var SerializerInterface $serializer
     * @Assert\NotNull(message="Serializer should be provided")
     */
    protected $serializer;

    /**
     * @var LoggerInterface $logger
     */
    protected $logger;

    /**
     * @var Environment $environment
     */
    protected $env;

    /**
     * Client constructor.
     *
     * @param AppDataInterface       $appData
     */
    public function __construct(AppDataInterface $appData)
    {
        $this->appData = $appData;
    }

    /**
     * @throws ValidationException
     */
    public function validateSelf(): void
    {
        $this->validate($this);
        $this->validate($this->appData);
    }

    /**
     * @param ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    /**
     * @param RequestFactoryInterface $requestFactory
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return Client
     */
    public function setLogger(LoggerInterface $logger): Client
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param Environment $env
     *
     * @return Client
     */
    public function setEnv(Environment $env): Client
    {
        $this->env = $env;
        return $this;
    }

    /**
     * Send request. Can throw several exceptions:
     *  - ValidationException - when request didn't pass validation.
     *  - FactoryException - when PSR-7 request cannot be built.
     *  - ClientException - when PSR-7 request cannot be processed by client. Previous error will contain HTTP
     *    client processing error (if it's present).
     *  - LocalApiException - when request is not processed and API returned error. Note: this exception is only thrown
     *    when request cannot be processed by API at all (for example, if token is invalid). It will not be thrown
     *    if request was processed, but API returned error in the response result. In that case you can use error fields
     *    from the response result itself; those results implement ErrorInterface via ErrorTrait.
     *    However, some result classes may contain different format for error data. Those result classes won't implement
     *    ErrorInterface - you can use `instanceof` to differentiate such results from the others. This inconsistency
     *    is brought by the API design itself, and cannot be easily removed.
     *
     * @param BaseRequest $request
     *
     * @return ResponseInterface
     * @throws ValidationException
     * @throws FactoryException
     * @throws ClientException
     * @throws LocalApiException
     */
    public function sendRequest(BaseRequest $request): ResponseInterface
    {
        $httpRequest = $this->requestFactory->fromModel($request, $this->appData);

        try {
            $httpResponse = $this->httpClient->sendRequest($httpRequest);
        } catch (ClientExceptionInterface $exception) {
            throw new ClientException(sprintf('Error sending request: %s', $exception->getMessage()), 0, $exception);
        }

        $bodyData = self::getBodyContents($httpResponse->getBody());

        if ($this->debugLogging()) {
            $this->logger->debug(
                sprintf(
                    '<AliExpress TOP Client> Request %s (%s) (%s): got response %s',
                    $request->getMethod(),
                    $httpRequest->getUri()->__toString(),
                    $httpRequest->getBody()->__toString(),
                    $bodyData
                )
            );
        }

        /** @var BaseResponse $response */
        $response = $this->serializer->deserialize(
            $bodyData,
            $request->getExpectedResponse(),
            'json'
        );

        if (!($response instanceof BaseResponse) && !is_subclass_of($response, BaseResponse::class)) {
            throw new ClientException(sprintf('Invalid response class: %s', get_class($response)));
        }

        if (null !== $response->errorResponse) {
            if ($this->debugLogging()) {
                $this->logger->debug(
                    sprintf(
                        '<AliExpress TOP Client> Request %s (%s) (%s): got error response %s',
                        $request->getMethod(),
                        $httpRequest->getUri()->__toString(),
                        $httpRequest->getBody()->__toString(),
                        $bodyData
                    )
                );
            }

            throw new LocalApiException($response->errorResponse);
        }

        return $response;
    }

    /**
     * @return bool
     */
    protected function debugLogging(): bool
    {
        return null !== $this->logger && !($this->logger instanceof NullLogger) && $this->env->isDebug();
    }

    /**
     * Returns body stream data (it should work like that in order to keep compatibility with some implementations).
     *
     * @param StreamInterface $stream
     *
     * @return string
     */
    protected static function getBodyContents(StreamInterface $stream): string
    {
        return $stream->isSeekable() ? $stream->__toString() : $stream->getContents();
    }
}
