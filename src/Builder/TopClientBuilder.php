<?php

/**
 * PHP version 7.3
 *
 * @category TopClientBuilder
 * @package  RetailCrm\Builder
 */
namespace RetailCrm\Builder;

use RetailCrm\Component\Constants;
use RetailCrm\Component\Environment;
use RetailCrm\Interfaces\AppDataInterface;
use RetailCrm\Interfaces\BuilderInterface;
use RetailCrm\Interfaces\ContainerAwareInterface;
use RetailCrm\Interfaces\TopRequestFactoryInterface;
use RetailCrm\TopClient\TopClient;
use RetailCrm\Traits\ContainerAwareTrait;

/**
 * Class TopClientBuilder
 *
 * @category TopClientBuilder
 * @package  RetailCrm\Builder
 */
class TopClientBuilder implements ContainerAwareInterface, BuilderInterface
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
     * @return TopClientBuilder
     */
    public function setAppData(AppDataInterface $appData): TopClientBuilder
    {
        $this->appData = $appData;
        return $this;
    }

    /**
     * @return \RetailCrm\TopClient\TopClient
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    public function build(): TopClient
    {
        $client = new TopClient($this->appData);
        $client->setHttpClient($this->container->get(Constants::HTTP_CLIENT));
        $client->setSerializer($this->container->get(Constants::SERIALIZER));
        $client->setValidator($this->container->get(Constants::VALIDATOR));
        $client->setEnv($this->container->get(Environment::class));
        $client->setLogger($this->container->get(Constants::LOGGER));
        $client->setRequestFactory($this->container->get(TopRequestFactoryInterface::class));

        $client->validateSelf();

        return $client;
    }
}
