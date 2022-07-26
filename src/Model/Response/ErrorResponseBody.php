<?php

/**
 * PHP version 7.3
 *
 * @category ErrorResponseBody
 * @package  RetailCrm\Model\Response
 */
namespace RetailCrm\Model\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class ErrorResponseBody
 *
 * @category ErrorResponseBody
 * @package  RetailCrm\Model\Response
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
