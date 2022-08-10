<?php
/**
 * PHP version 7.3
 *
 * @category AvailableSignMethods
 * @package  Simla\Model\Enum
 */

namespace Simla\Model\Enum;

/**
 * Class AvailableSignMethods
 *
 * @category AvailableSignMethods
 * @package  Simla\Model\Enum
 */
class AvailableSignMethods
{
    public const MD5 = 'md5';
    public const HMAC_MD5 = 'hmac';
    public const AVAILABLE_METHODS = [self::MD5, self::HMAC_MD5];
}
