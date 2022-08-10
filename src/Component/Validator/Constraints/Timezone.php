<?php
/**
 * PHP version 7.3
 *
 * @category Timezone
 * @package  Simla\Component\Validator\Constraints
 */

namespace Simla\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Timezone
 *
 * @category Timezone
 * @package  Simla\Component\Validator\Constraints
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Timezone extends Constraint
{
    public $timezone = 'PST';
    public $message = 'Invalid timezone provided. Got {{ provided }}, should be {{ expected }}.';

    /**
     * {@inheritdoc}
     */
    public function getDefaultOption(): string
    {
        return 'timezone';
    }
}
