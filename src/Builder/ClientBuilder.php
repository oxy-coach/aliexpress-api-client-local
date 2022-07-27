<?php

/**
 * PHP version 7.3
 *
 * @category ClientBuilder
 * @package  RetailCrm\Builder
 */
namespace RetailCrm\Builder;

use RetailCrm\Component\Constants;
use RetailCrm\Component\Environment;
use RetailCrm\Interfaces\AppDataInterface;
use RetailCrm\Interfaces\BuilderInterface;
use RetailCrm\Interfaces\ContainerAwareInterface;
use RetailCrm\Interfaces\RequestFactoryInterface;
use RetailCrm\Client\Client;
use RetailCrm\Traits\ContainerAwareTrait;

/**
 * Class ClientBuilder
 *
 * @category ClientBuilder
 * @package  RetailCrm\Builder
 */
class ClientBuilder implements ContainerAwareInterface, BuilderInterface
{
    use ContainerAwareTrait;

    /** @var \RetailCrm\Interfaces\AppDataInterface $appData */
    private $appData;

    /**
     * @return static
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * @param \RetailCrm\Interfaces\AppDataInterface $appData
     *
     * @return ClientBuilder
     */
    public function setAppData(AppDataInterface $appData): ClientBuilder
    {
        $this->appData = $appData;
        return $this;
    }

    /**
     * @return \RetailCrm\Client\Client
     * @throws \RetailCrm\Component\Exception\ValidationException
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
