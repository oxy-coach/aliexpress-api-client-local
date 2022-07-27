<?php

namespace RetailCrm\Client;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use RetailCrm\Component\Environment;
use RetailCrm\Component\Exception\LocalApiException;
use RetailCrm\Component\Exception\ClientException;
use RetailCrm\Interfaces\AppDataInterface;
use RetailCrm\Interfaces\ClientInterface as LocalClientInterface;
use RetailCrm\Interfaces\RequestFactoryInterface;
use RetailCrm\Model\Request\BaseRequest;
use RetailCrm\Model\Response\BaseResponse;
use RetailCrm\Model\Response\ResponseInterface;
use RetailCrm\Traits\ValidatorAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Client
 *
 * @category Client
 * @package  RetailCrm\Client
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Client implements LocalClientInterface
{
    use ValidatorAwareTrait;

    /**
     * @var \RetailCrm\Interfaces\AppDataInterface $appData
     */
    protected $appData;

    /**
     * @var ClientInterface $httpClient
     * @Assert\NotNull(message="HTTP client should be provided")
     */
    protected $httpClient;

    /**
     * @var \RetailCrm\Interfaces\RequestFactoryInterface $requestFactory
     * @Assert\NotNull(message="RequestFactoryInterface should be provided")
     */
    protected $requestFactory;

    /**
     * @var SerializerInterface $serializer
     * @Assert\NotNull(message="Serializer should be provided")
     */
    protected $serializer;

    /**
     * @var \Psr\Log\LoggerInterface $logger
     */
    protected $logger;

    /**
     * @var Environment $environment
     */
    protected $env;

    /**
     * Client constructor.
     *
     * @param \RetailCrm\Interfaces\AppDataInterface       $appData
     */
    public function __construct(AppDataInterface $appData)
    {
        $this->appData = $appData;
    }

    /**
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    public function validateSelf(): void
    {
        $this->validate($this);
        $this->validate($this->appData);
    }

    /**
     * @param \Psr\Http\Client\ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param \JMS\Serializer\SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    /**
     * @param \RetailCrm\Interfaces\RequestFactoryInterface $requestFactory
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return Client
     */
    public function setLogger(LoggerInterface $logger): Client
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param \RetailCrm\Component\Environment $env
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
     * @param \RetailCrm\Model\Request\BaseRequest $request
     *
     * @return ResponseInterface
     * @throws \RetailCrm\Component\Exception\ValidationException
     * @throws \RetailCrm\Component\Exception\FactoryException
     * @throws \RetailCrm\Component\Exception\ClientException
     * @throws \RetailCrm\Component\Exception\LocalApiException
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
     * @param \Psr\Http\Message\StreamInterface $stream
     *
     * @return string
     */
    protected static function getBodyContents(StreamInterface $stream): string
    {
        return $stream->isSeekable() ? $stream->__toString() : $stream->getContents();
    }
}
