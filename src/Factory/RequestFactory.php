<?php

/**
 * PHP version 7.3
 *
 * @category RequestFactory
 * @package  RetailCrm\Factory
 */
namespace RetailCrm\Factory;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use RetailCrm\Component\Exception\FactoryException;
use RetailCrm\Interfaces\AppDataInterface;
use RetailCrm\Interfaces\RequestFactoryInterface as LocalRequestFactoryInterface;
use RetailCrm\Model\Request\BaseRequest;

/**
 * Class RequestFactory
 *
 * @category RequestFactory
 * @package  RetailCrm\Factory
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RequestFactory implements LocalRequestFactoryInterface
{
    /**
     * @var SerializerInterface|\JMS\Serializer\Serializer $serializer
     */
    private $serializer;

    /**
     * @var StreamFactoryInterface $streamFactory
     */
    private $streamFactory;

    /**
     * @var \Psr\Http\Message\RequestFactoryInterface $requestFactory
     */
    private $requestFactory;

    /**
     * @var \Psr\Http\Message\UriFactoryInterface $uriFactory
     */
    private $uriFactory;

    /**
     * @param \JMS\Serializer\Serializer|\JMS\Serializer\SerializerInterface $serializer
     *
     * @return RequestFactory
     */
    public function setSerializer($serializer): RequestFactory
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * @param \Psr\Http\Message\StreamFactoryInterface $streamFactory
     *
     * @return RequestFactory
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): RequestFactory
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    /**
     * @param \Psr\Http\Message\RequestFactoryInterface $requestFactory
     *
     * @return RequestFactory
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): RequestFactory
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    /**
     * @param \Psr\Http\Message\UriFactoryInterface $uriFactory
     *
     * @return RequestFactory
     */
    public function setUriFactory(UriFactoryInterface $uriFactory): RequestFactory
    {
        $this->uriFactory = $uriFactory;
        return $this;
    }

    /**
     * @param \RetailCrm\Model\Request\BaseRequest         $request
     * @param \RetailCrm\Interfaces\AppDataInterface       $appData
     *
     * @return \Psr\Http\Message\RequestInterface
     * @throws \RetailCrm\Component\Exception\FactoryException
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
