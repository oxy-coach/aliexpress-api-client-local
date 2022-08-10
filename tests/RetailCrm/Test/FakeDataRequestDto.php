<?php
/**
 * PHP version 7.4
 *
 * @category FakeDataRequestDto
 * @package  Simla\Test
 */

namespace RetailCrm\Test;

use Simla\Interfaces\RequestDtoInterface;
use JMS\Serializer\Annotation as JMS;

/**
 * Class FakeDataRequestDto
 *
 * @category FakeDataRequestDto
 * @package  Simla\Test
 */
class FakeDataRequestDto implements RequestDtoInterface
{
    /**
     * @var string $code
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("code")
     */
    public $code;
}
