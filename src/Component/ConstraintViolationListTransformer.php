<?php
/**
 * PHP version 7.3
 *
 * @category ConstraintViolationListTransformer
 * @package  Simla\Component
 */

namespace Simla\Component;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Class ConstraintViolationListTransformer
 *
 * @category ConstraintViolationListTransformer
 * @package  Simla\Component
 */
class ConstraintViolationListTransformer
{
    /**
     * Returns property names with their respective errors.
     *
     * @param ConstraintViolationListInterface $violationList
     *
     * @return array
     */
    public static function getViolationsArray(ConstraintViolationListInterface $violationList): array
    {
        $violations = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($violationList as $violation) {
            $violations[$violation->getPropertyPath()] = (string) $violation->getMessage();
        }

        return $violations;
    }
}
