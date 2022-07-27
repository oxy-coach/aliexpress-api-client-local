<?php

/**
 * PHP version 7.3
 *
 * @category LocalApiException
 * @package  RetailCrm\Component\Exception
 */
namespace RetailCrm\Component\Exception;

use Exception;
use RetailCrm\Model\Response\ErrorResponseBody;
use Throwable;

/**
 * Class LocalApiException
 *
 * @category LocalApiException
 * @package  RetailCrm\Component\Exception
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
     * @param \RetailCrm\Model\Response\ErrorResponseBody $responseBody
     * @param \Throwable|null                             $previous
     */
    public function __construct(ErrorResponseBody $responseBody, Throwable $previous = null)
    {
        parent::__construct($responseBody->message, $responseBody->code, $previous);

        $this->error = $responseBody;
    }

    /**
     * @return \RetailCrm\Model\Response\ErrorResponseBody
     */
    public function getError(): ErrorResponseBody
    {
        return $this->error;
    }
}
