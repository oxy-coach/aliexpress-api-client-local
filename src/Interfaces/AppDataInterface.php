<?php

/**
 * PHP version 7.3
 *
 * @category AppDataInterface
 * @package  Simla\Interfaces
 */

namespace Simla\Interfaces;

/**
 * Interface AppDataInterface
 *
 * @category AppDataInterface
 * @package  Simla\Interfaces
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
