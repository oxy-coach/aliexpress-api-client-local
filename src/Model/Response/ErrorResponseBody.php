<?php

/**
 * PHP version 7.3
 *
 * @category ErrorResponseBody
 * @package  Simla\Model\Response
 */
namespace Simla\Model\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class ErrorResponseBody
 *
 * @category ErrorResponseBody
 * @package  Simla\Model\Response
 */
class ErrorResponseBody
{
    /**
     * @var int $code
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("code")
     */
    public $code;

    /**
     * @var string $msg
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("message")
     */
    public $message;
}
