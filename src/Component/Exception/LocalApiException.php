<?php

/**
 * PHP version 7.3
 *
 * @category LocalApiException
 * @package  Simla\Component\Exception
 */
namespace Simla\Component\Exception;

use Exception;
use Simla\Model\Response\ErrorResponseBody;
use Throwable;

/**
 * Class LocalApiException
 *
 * @category LocalApiException
 * @package  Simla\Component\Exception
 */
class LocalApiException extends Exception
{
    /**
     * @var ErrorResponseBody $error
     */
    private $error;

    /**
     * LocalApiException constructor.
     *
     * @param ErrorResponseBody $responseBody
     * @param Throwable|null    $previous
     */
    public function __construct(ErrorResponseBody $responseBody, Throwable $previous = null)
    {
        parent::__construct($responseBody->message, $responseBody->code, $previous);

        $this->error = $responseBody;
    }

    /**
     * @return ErrorResponseBody
     */
    public function getError(): ErrorResponseBody
    {
        return $this->error;
    }
}
