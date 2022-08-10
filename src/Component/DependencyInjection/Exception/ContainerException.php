<?php

/**
 * PHP version 7.3
 *
 * @category ContainerException
 * @package  Simla\Component\DependencyInjection\Exception
 */
namespace Simla\Component\DependencyInjection\Exception;

use Psr\Container\ContainerExceptionInterface;
use LogicException;

/**
 * Class ContainerException
 *
 * @category ContainerException
 * @package  Simla\Component\DependencyInjection\Exception
 * @author   Evgeniy Zyubin <mail@devanych.ru>
 */
class ContainerException extends LogicException implements ContainerExceptionInterface
{
}
