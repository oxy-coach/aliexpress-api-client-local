<?php

namespace RetailCrm\Test;

use Http\Client\Curl\Client as CurlClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client as MockClient;
use InvalidArgumentException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RetailCrm\Builder\ContainerBuilder;
use RetailCrm\Component\AppData;
use RetailCrm\Component\Constants;
use RetailCrm\Component\Environment;
use RetailCrm\Interfaces\AppDataInterface;
use RetailCrm\Model\Request\GetOrderListRequest;

/**
 * Class TestCase
 *
 * @category TestCase
 * @package  ${NAMESPACE}
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    private $container;

    /**
     * @param \Psr\Http\Client\ClientInterface|null $client
     * @param bool                                  $recreate
     *
     * @return \Psr\Container\ContainerInterface
     */
    protected function getContainer(?ClientInterface $client = null, $recreate = false): ContainerInterface
    {
        if (null === $this->container || null !== $client || $recreate) {
            $factory = new Psr17Factory();
            $this->container = ContainerBuilder::create()
                ->setEnv(Environment::TEST)
                ->setClient(is_null($client) ? self::getMockClient() : $client)
                ->setStreamFactory($factory)
                ->setRequestFactory($factory)
                ->setUriFactory($factory)
                ->build();
        }

        return $this->container;
    }

    /**
     * @return \RetailCrm\Interfaces\AppDataInterface
     */
    protected function getEnvAppData(): AppDataInterface
    {
        return $this->getAppData(
            self::getenv('ENDPOINT', AppData::ENDPOINT),
            self::getenv('TOKEN', 'test_token'),
        );
    }

    /**
     * @param string $endpoint
     * @param string $token
     *
     * @return \RetailCrm\Interfaces\AppDataInterface
     */
    protected function getAppData(
        string $endpoint = AppData::ENDPOINT,
        string $token = 'token'
    ): AppDataInterface{
        return new AppData($endpoint, $token);
    }

    /**
     * @param string $signMethod
     *
     * @param bool $withDto
     *
     * @return GetOrderListRequest
     */
    protected function getTestRequest(): GetOrderListRequest
    {
        $request = new GetOrderListRequest();
        $request->page = 1;

        return $request;
    }

    /**
     * @param int                 $code
     * @param object|array|string $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws InvalidArgumentException
     */
    protected function responseJson(int $code, $response): ResponseInterface
    {
        /** @var \JMS\Serializer\SerializerInterface $serializer */
        $serializer = $this->getContainer()->get(Constants::SERIALIZER);
        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        $data = null;

        switch (gettype($response)) {
            case 'string':
                $data = $streamFactory->createStream($response);
                break;
            case 'array':
            case 'object':
                $data = $streamFactory->createStream($serializer->serialize($response, 'json'));
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Expected string, object, or array, got "%s"',
                    gettype($response)
                ));
        }

        return $responseFactory->createResponse($code)
            ->withHeader('Content-Type', 'application/json')
            ->withBody($data);
    }

    /**
     * @param string $variable
     * @param mixed  $default
     *
     * @return mixed|null
     */
    protected static function getenv(string $variable, $default = null)
    {
        if (!array_key_exists($variable, $_ENV)) {
            return $default;
        }

        return $_ENV[$variable];
    }

    /**
     * @return \Http\Mock\Client
     */
    protected static function getMockClient(): MockClient
    {
        $client = new MockClient();
        $client->setDefaultException(new MatcherException());
        return $client;
    }

    /**
     * @return \Psr\Http\Client\ClientInterface
     */
    protected static function getCurlClient(): ClientInterface
    {
        return new CurlClient();
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $stream
     *
     * @return string
     */
    protected static function getStreamData(StreamInterface $stream): string
    {
        $data = '';

        if ($stream->isSeekable()) {
            $data = $stream->__toString();
            $stream->seek(0);
        } else {
            $data = $stream->getContents();
        }

        return $data;
    }
}
