<?php

/**
 * PHP version 7.3
 *
 * @category ClientFactory
 * @package  RetailCrm\Factory
 */
namespace RetailCrm\Factory;

use RetailCrm\Builder\ContainerBuilder;
use RetailCrm\Builder\ClientBuilder;
use RetailCrm\Component\AppData;
use RetailCrm\Client\Client;

/**
 * Class ClientFactory
 *
 * @category ClientFactory
 * @package  RetailCrm\Factory
 */
class ClientFactory
{
    /**
     * Create new Client
     *
     * @param string $baseUrl
     * @param string $token
     *
     * @return Client
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    public static function createClient(
        string $baseUrl,
        string $token
    ): Client {
        $appData = new AppData($baseUrl, $token);
        $builder = ClientBuilder::create()
            ->setContainer(ContainerBuilder::create()->build())
            ->setAppData($appData);

        return $builder->build();
    }
}
