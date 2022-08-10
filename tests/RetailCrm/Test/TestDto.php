<?php

/**
 * PHP version 7.3
 *
 * @category TestDto
 * @package  Simla\Test
 */
namespace RetailCrm\Test;

use JMS\Serializer\Annotation as JMS;
use Simla\Interfaces\RequestDtoInterface;

/**
 * Class TestDto
 *
 * @category TestDto
 * @package  Simla\Test
 */
class TestDto implements RequestDtoInterface
{
    /**
     * @var string $modelContent
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("modelContent")
     */
    public $modelContent = 'contentData';
}
