<?php

/**
 * PHP version 7.3
 *
 * @category TopClient
 * @package  RetailCrm\TopClient
 */
namespace RetailCrm\TopClient;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use RetailCrm\Component\Environment;
use RetailCrm\Component\Exception\TopApiException;
use RetailCrm\Component\Exception\TopClientException;
use RetailCrm\Interfaces\AppDataInterface;
use RetailCrm\Interfaces\TopClientInterface;
use RetailCrm\Interfaces\TopRequestFactoryInterface;
use RetailCrm\Model\Request\BaseRequest;
use RetailCrm\Model\Response\BaseResponse;
use RetailCrm\Model\Response\TopResponseInterface;
use RetailCrm\Traits\ValidatorAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TopClient
 *
 * @category TopClient
 * @package  RetailCrm\TopClient
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class TopClient implements TopClientInterface
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
     * @var \RetailCrm\Interfaces\TopRequestFactoryInterface $requestFactory
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
     * TopClient constructor.
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
     * @param \RetailCrm\Interfaces\TopRequestFactoryInterface $requestFactory
     */
    public function setRequestFactory(TopRequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return TopClient
     */
    public function setLogger(LoggerInterface $logger): TopClient
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param \RetailCrm\Component\Environment $env
     *
     * @return TopClient
     */
    public function setEnv(Environment $env): TopClient
    {
        $this->env = $env;
        return $this;
    }

    /**
     * Send TOP request. Can throw several exceptions:
     *  - ValidationException - when request didn't pass validation.
     *  - FactoryException - when PSR-7 request cannot be built.
     *  - TopClientException - when PSR-7 request cannot be processed by client. Previous error will contain HTTP
     *    client processing error (if it's present).
     *  - TopApiException - when request is not processed and API returned error. Note: this exception is only thrown
     *    when request cannot be processed by API at all (for example, if signature is invalid). It will not be thrown
     *    if request was processed, but API returned error in the response result. In that case you can use error fields
     *    from the response result itself; those results implement ErrorInterface via ErrorTrait.
     *    However, some result classes may contain different format for error data. Those result classes won't implement
     *    ErrorInterface - you can use `instanceof` to differentiate such results from the others. This inconsistency
     *    is brought by the API design itself, and cannot be easily removed.
     *
     * @param \RetailCrm\Model\Request\BaseRequest $request
     *
     * @return TopResponseInterface
     * @throws \RetailCrm\Component\Exception\ValidationException
     * @throws \RetailCrm\Component\Exception\FactoryException
     * @throws \RetailCrm\Component\Exception\TopClientException
     * @throws \RetailCrm\Component\Exception\TopApiException
     */
    public function sendRequest(BaseRequest $request): TopResponseInterface
    {
        $httpRequest = $this->requestFactory->fromModel($request, $this->appData);

        try {
            $httpResponse = $this->httpClient->sendRequest($httpRequest);
        } catch (ClientExceptionInterface $exception) {
            throw new TopClientException(sprintf('Error sending request: %s', $exception->getMessage()), 0, $exception);
        }

        $bodyData = self::getBodyContents($httpResponse->getBody());

        if ($this->debugLogging()) {
            $this->logger->debug(sprintf(
                '<AliExpress TOP Client> Request %s (%s) (%s): got response %s',
                $request->getMethod(),
                $httpRequest->getUri()->__toString(),
                $httpRequest->getBody()->__toString(),
                $bodyData
            ));
        }

        /** @var BaseResponse $response */
        $response = $this->serializer->deserialize(
            $bodyData,
            $request->getExpectedResponse(),
            'json'
        );

        if (!($response instanceof BaseResponse) && !is_subclass_of($response, BaseResponse::class)) {
            throw new TopClientException(sprintf('Invalid response class: %s', get_class($response)));
        }

        if (null !== $response->errorResponse) {
            if ($this->debugLogging()) {
                $this->logger->debug(sprintf(
                    '<AliExpress TOP Client> Request %s (%s) (%s): got error response %s',
                    $request->getMethod(),
                    $httpRequest->getUri()->__toString(),
                    $httpRequest->getBody()->__toString(),
                    $bodyData
                ));
            }

            throw new TopApiException($response->errorResponse);
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
