<?php

/**
 * PHP version 7.3
 *
 * @category ClientInterface
 * @package  Simla\Interfaces
 */
namespace Simla\Interfaces;

use Simla\Model\Request\BaseRequest;
use Simla\Model\Response\ResponseInterface;
use Simla\Component\Exception\ValidationException;
use Simla\Component\Exception\FactoryException;
use Simla\Component\Exception\ClientException;
use Simla\Component\Exception\LocalApiException;

/**
 * Class ClientInterface
 *
 * @category ContainerBuilder
 * @package  Simla\Interfaces
 *
 */
interface ClientInterface
{
    /**
     * Send TOP request
     *
     * @param BaseRequest $request
     *
     * @return ResponseInterface
     * @throws ValidationException
     * @throws FactoryException
     * @throws ClientException
     * @throws LocalApiException
     */
    public function sendRequest(BaseRequest $request): ResponseInterface;
}
