<?php

/**
 * PHP version 7.3
 *
 * @category ClientBuilder
 * @package  Simla\Builder
 */
namespace Simla\Builder;

use Simla\Component\Constants;
use Simla\Component\Environment;
use Simla\Component\Exception\ValidationException;
use Simla\Interfaces\AppDataInterface;
use Simla\Interfaces\BuilderInterface;
use Simla\Interfaces\ContainerAwareInterface;
use Simla\Interfaces\RequestFactoryInterface;
use Simla\Client\Client;
use Simla\Traits\ContainerAwareTrait;

/**
 * Class ClientBuilder
 *
 * @category ClientBuilder
 * @package  Simla\Builder
 */
class ClientBuilder implements ContainerAwareInterface, BuilderInterface
{
    use ContainerAwareTrait;

    /** @var AppDataInterface $appData */
    private $appData;

    /**
     * @return static
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * @param AppDataInterface $appData
     *
     * @return ClientBuilder
     */
    public function setAppData(AppDataInterface $appData): ClientBuilder
    {
        $this->appData = $appData;
        return $this;
    }

    /**
     * @return Client
     * @throws ValidationException
     */
    public function build(): Client
    {
        $client = new Client($this->appData);
        $client->setHttpClient($this->container->get(Constants::HTTP_CLIENT));
        $client->setSerializer($this->container->get(Constants::SERIALIZER));
        $client->setValidator($this->container->get(Constants::VALIDATOR));
        $client->setEnv($this->container->get(Environment::class));
        $client->setLogger($this->container->get(Constants::LOGGER));
        $client->setRequestFactory($this->container->get(RequestFactoryInterface::class));

        $client->validateSelf();

        return $client;
    }
}
