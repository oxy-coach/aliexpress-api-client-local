<?php

/**
 * PHP version 7.3
 *
 * @category RequestFactory
 * @package  Simla\Factory
 */
namespace Simla\Factory;

use JMS\Serializer\SerializerInterface;
use JMS\Serializer\Serializer;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Simla\Component\Exception\FactoryException;
use Simla\Interfaces\AppDataInterface;
use Simla\Interfaces\RequestFactoryInterface as LocalRequestFactoryInterface;
use Simla\Model\Request\BaseRequest;

/**
 * Class RequestFactory
 *
 * @category RequestFactory
 * @package  Simla\Factory
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RequestFactory implements LocalRequestFactoryInterface
{
    /**
     * @var SerializerInterface|Serializer $serializer
     */
    private $serializer;

    /**
     * @var StreamFactoryInterface $streamFactory
     */
    private $streamFactory;

    /**
     * @var RequestFactoryInterface $requestFactory
     */
    private $requestFactory;

    /**
     * @var UriFactoryInterface $uriFactory
     */
    private $uriFactory;

    /**
     * @param Serializer|SerializerInterface $serializer
     *
     * @return RequestFactory
     */
    public function setSerializer($serializer): RequestFactory
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * @param StreamFactoryInterface $streamFactory
     *
     * @return RequestFactory
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): RequestFactory
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    /**
     * @param RequestFactoryInterface $requestFactory
     *
     * @return RequestFactory
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): RequestFactory
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    /**
     * @param UriFactoryInterface $uriFactory
     *
     * @return RequestFactory
     */
    public function setUriFactory(UriFactoryInterface $uriFactory): RequestFactory
    {
        $this->uriFactory = $uriFactory;
        return $this;
    }

    /**
     * @param BaseRequest         $request
     * @param AppDataInterface    $appData
     *
     * @return RequestInterface
     * @throws FactoryException
     */
    public function fromModel(
        BaseRequest $request,
        AppDataInterface $appData
    ): RequestInterface {
        $postData = $this->serializer->serialize($request, 'json');

        try {
            return $this->requestFactory
                ->createRequest(
                    'POST',
                    $this->uriFactory->createUri($appData->getBaseUrl() . $request->getMethod())
                )->withBody($this->streamFactory->createStream($postData))
                ->withHeader('content-type', 'application/json; charset=UTF-8')
                ->withHeader('x-auth-token', $appData->getToken());
        } catch (\Exception $exception) {
            throw new FactoryException(
                sprintf('Error building request: %s', $exception->getMessage()),
                0,
                $exception
            );
        }
    }
}
