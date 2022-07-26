<?php

/**
 * PHP version 7.3
 *
 * @category TopClientInterface
 * @package  RetailCrm\Interfaces
 */
namespace RetailCrm\Interfaces;

use RetailCrm\Model\Request\BaseRequest;
use RetailCrm\Model\Response\TopResponseInterface;

/**
 * Class TopClientInterface
 *
 * @category ContainerBuilder
 * @package  RetailCrm\Interfaces
 *
 */
interface TopClientInterface
{
    /**
     * Send TOP request
     *
     * @param \RetailCrm\Model\Request\BaseRequest $request
     *
     * @return TopResponseInterface
     * @throws \RetailCrm\Component\Exception\ValidationException
     * @throws \RetailCrm\Component\Exception\FactoryException
     * @throws \RetailCrm\Component\Exception\TopClientException
     * @throws \RetailCrm\Component\Exception\TopApiException
     */
    public function sendRequest(BaseRequest $request): TopResponseInterface;
}
