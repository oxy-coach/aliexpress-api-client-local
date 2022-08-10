<?php

/**
 * PHP version 7.3
 *
 * @category ValidationException
 * @package  Simla\Component\Exception
 */
namespace Simla\Component\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

/**
 * Class ValidationException
 *
 * @category ValidationException
 * @package  Simla\Component\Exception
 */
class ValidationException extends \Exception
{
    /**
     * @var ConstraintViolationListInterface|null
     */
    private $violations;

    /**
     * ValidationException constructor.
     *
     * @param string                                $message
     * @param ConstraintViolationListInterface|null $violations
     * @param int                                   $code
     * @param Throwable|null                        $previous
     */
    public function __construct(
        $message = "",
        ?ConstraintViolationListInterface $violations = null,
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->violations = $violations;
    }

    /**
     * @return ConstraintViolationListInterface|null
     */
    public function getViolations(): ?ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
