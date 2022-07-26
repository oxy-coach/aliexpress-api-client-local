<?php

/**
 * PHP version 7.3
 *
 * @category AppDataInterface
 * @package  RetailCrm\Interfaces
 */

namespace RetailCrm\Interfaces;

/**
 * Interface AppDataInterface
 *
 * @category AppDataInterface
 * @package  RetailCrm\Interfaces
 */
interface AppDataInterface
{
    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return string
     */
    public function getToken(): string;
}
