<?php

/**
 * PHP version 7.3
 *
 * @category RequestTimestampProviderInterface
 * @package  Simla\Interfaces
 */

namespace Simla\Interfaces;

use Simla\Model\Request\BaseRequest;

/**
 * Interface RequestTimestampProviderInterface
 *
 * @category RequestTimestampProviderInterface
 * @package  Simla\Interfaces
 */
interface RequestTimestampProviderInterface
{
    /**
     * Sets current timestamp in GMT +8 timezone in the request
     *
     * @param BaseRequest $request
     *
     * @return void
     */
    public function provide(BaseRequest $request): void;
}
