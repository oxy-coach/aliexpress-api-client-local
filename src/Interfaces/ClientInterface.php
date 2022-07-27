<?php

/**
 * PHP version 7.3
 *
 * @category ClientInterface
 * @package  RetailCrm\Interfaces
 */
namespace RetailCrm\Interfaces;

use RetailCrm\Model\Request\BaseRequest;
use RetailCrm\Model\Response\ResponseInterface;

/**
 * Class ClientInterface
 *
 * @category ContainerBuilder
 * @package  RetailCrm\Interfaces
 *
 */
interface ClientInterface
{
    /**
     * Send TOP request
     *
     * @param \RetailCrm\Model\Request\BaseRequest $request
     *
     * @return ResponseInterface
     * @throws \RetailCrm\Component\Exception\ValidationException
     * @throws \RetailCrm\Component\Exception\FactoryException
     * @throws \RetailCrm\Component\Exception\ClientException
     * @throws \RetailCrm\Component\Exception\LocalApiException
     */
    public function sendRequest(BaseRequest $request): ResponseInterface;
}
