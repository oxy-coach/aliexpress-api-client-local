<?php
/**
 * PHP version 7.3
 *
 * @category AvailableResponseFormats
 * @package  Simla\Model\Enum
 */

namespace Simla\Model\Enum;

/**
 * Class AvailableResponseFormats
 *
 * @category AvailableResponseFormats
 * @package  Simla\Model\Enum
 */
class AvailableResponseFormats
{
    public const XML = 'xml';
    public const JSON = 'json';
    public const AVAILABLE_FORMATS = [self::JSON, self::XML];
}
