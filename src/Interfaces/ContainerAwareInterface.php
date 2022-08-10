<?php

/**
 * PHP version 7.3
 *
 * @category ContainerAwareInterface
 * @package  Simla\Interfaces
 */

namespace Simla\Interfaces;

use Psr\Container\ContainerInterface;

/**
 * Interface ContainerAwareInterface
 *
 * @category ContainerAwareInterface
 * @package  Simla\Interfaces
 */
interface ContainerAwareInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function setContainer(ContainerInterface $container);

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface;
}
