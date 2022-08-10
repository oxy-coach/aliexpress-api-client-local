<?php

/**
 * PHP version 7.3
 *
 * @category ContainerAwareTrait
 * @package  Simla\Traits
 */

namespace Simla\Traits;

use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait ContainerAwareTrait
 *
 * @category ContainerAwareTrait
 * @package  Simla\Traits
 */
trait ContainerAwareTrait
{
    /**
     * @var ContainerInterface $container
     * @Assert\NotNull(message="Container should be provided")
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     *
     * @return ContainerAwareTrait
     */
    public function setContainer(ContainerInterface $container): self
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
