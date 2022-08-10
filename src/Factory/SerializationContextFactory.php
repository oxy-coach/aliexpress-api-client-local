<?php

/**
 * PHP version 7.3
 *
 * @category SerializationContextFactory
 * @package  Simla\Factory
 */
namespace Simla\Factory;

use JMS\Serializer\ContextFactory\SerializationContextFactoryInterface;
use JMS\Serializer\SerializationContext;

/**
 * Class SerializationContextFactory
 *
 * @category SerializationContextFactory
 * @package  Simla\Factory
 */
class SerializationContextFactory implements SerializationContextFactoryInterface
{
    /**
     * @return \JMS\Serializer\SerializationContext
     */
    public function createSerializationContext(): SerializationContext
    {
        return SerializationContext::create()->setSerializeNull(false);
    }
}
