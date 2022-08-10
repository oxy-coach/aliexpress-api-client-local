<?php

/**
 * PHP version 7.3
 *
 * @category NotFoundException
 * @package  Simla\Component\DependencyInjection\Exception
 */
namespace Simla\Component\DependencyInjection\Exception;

use Psr\Container\NotFoundExceptionInterface;
use InvalidArgumentException;

/**
 * Class NotFoundException
 *
 * @category NotFoundException
 * @package  Simla\Component\DependencyInjection\Exception
 * @author   Evgeniy Zyubin <mail@devanych.ru>
 */
class NotFoundException extends InvalidArgumentException implements NotFoundExceptionInterface
{
}
