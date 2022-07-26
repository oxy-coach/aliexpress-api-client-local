<?php

/**
 * PHP version 7.3
 *
 * @category SerializerFactory
 * @package  Simla\Factory
 */
namespace Simla\Factory;

use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\Visitor\Factory\JsonSerializationVisitorFactory;
use Psr\Container\ContainerInterface;
use Simla\Component\Constants;
use Simla\Component\JMS\EventSubscriber\TimezoneDeserializeSubscriber;
use Simla\Component\JMS\Factory\JsonDeserializationVisitorFactory;
use Simla\Interfaces\FactoryInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use JMS\Serializer\Expression\ExpressionEvaluator;

/**
 * Class SerializerFactory
 *
 * @category SerializerFactory
 * @package  Simla\Factory
 */
class SerializerFactory implements FactoryInterface
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * SerializerFactory constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param ContainerInterface $container
     *
     * @return SerializerFactory
     */
    public static function withContainer(ContainerInterface $container): FactoryInterface
    {
        return new self($container);
    }

    /**
     * @return Serializer
     */
    public function create(): Serializer
    {
        $container = $this->container;

        return SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $registry) use ($container) {
                $returnNull = function ($visitor, $obj, array $type) {
                    return null;
                };
                $serializeJson = function ($visitor, $obj, array $type) use ($container) {
                    /** @var SerializerInterface $serializer */
                    $serializer = $container->get(Constants::SERIALIZER);
                    return $serializer->serialize($obj, 'json');
                };

                $registry->registerHandler(
                    GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                    'RequestDtoInterface',
                    'json',
                    $serializeJson
                );
                $registry->registerHandler(
                    GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                    'RequestDtoInterface',
                    'json',
                    $returnNull
                );
            })->addDefaultHandlers()
            ->configureListeners(function (EventDispatcher $dispatcher) {
                $dispatcher->addSubscriber(new TimezoneDeserializeSubscriber());
            })
            ->setSerializationVisitor('json', new JsonSerializationVisitorFactory())
            ->setDeserializationVisitor('json', new JsonDeserializationVisitorFactory())
            ->setSerializationContextFactory(new SerializationContextFactory())
            ->setExpressionEvaluator(new ExpressionEvaluator(new ExpressionLanguage()))
            ->build();
    }
}
