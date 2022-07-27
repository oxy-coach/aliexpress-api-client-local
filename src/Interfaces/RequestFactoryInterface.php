<?php

/**
 * PHP version 7.3
 *
 * @category RequestFactoryInterface
 * @package  RetailCrm\Interfaces
 */

namespace RetailCrm\Interfaces;

use Psr\Http\Message\RequestInterface;
use RetailCrm\Model\Request\BaseRequest;

/**
 * Interface RequestFactoryInterface
 *
 * @category RequestFactoryInterface
 * @package  RetailCrm\Interfaces
 */
interface RequestFactoryInterface
{
    /**
     * @param \RetailCrm\Model\Request\BaseRequest         $request
     * @param \RetailCrm\Interfaces\AppDataInterface       $appData
     *
     * @return RequestInterface
     * @throws \RetailCrm\Component\Exception\FactoryException
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    public function fromModel(
        BaseRequest $request,
        AppDataInterface $appData
    ): RequestInterface;
}
