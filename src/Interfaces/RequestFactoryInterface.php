<?php

/**
 * PHP version 7.3
 *
 * @category RequestFactoryInterface
 * @package  Simla\Interfaces
 */

namespace Simla\Interfaces;

use Psr\Http\Message\RequestInterface;
use Simla\Component\Exception\FactoryException;
use Simla\Component\Exception\ValidationException;
use Simla\Model\Request\BaseRequest;

/**
 * Interface RequestFactoryInterface
 *
 * @category RequestFactoryInterface
 * @package  Simla\Interfaces
 */
interface RequestFactoryInterface
{
    /**
     * @param BaseRequest         $request
     * @param AppDataInterface    $appData
     *
     * @return RequestInterface
     * @throws FactoryException
     * @throws ValidationException
     */
    public function fromModel(
        BaseRequest $request,
        AppDataInterface $appData
    ): RequestInterface;
}
