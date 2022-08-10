<?php

/**
 * PHP version 7.3
 *
 * @category BaseResponse
 * @package  Simla\Model\Response
 */
namespace Simla\Model\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class BaseResponse
 *
 * @category BaseResponse
 * @package  Simla\Model\Response
 */
abstract class BaseResponse implements ResponseInterface
{
    /**
     * @var \Simla\Model\Response\ErrorResponseBody
     *
     * @JMS\Type("Simla\Model\Response\ErrorResponseBody")
     * @JMS\SerializedName("error")
     */
    public $errorResponse;
}
