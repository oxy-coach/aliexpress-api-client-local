<?php

/**
 * PHP version 7.3
 *
 * @category TopClientFactory
 * @package  RetailCrm\Factory
 */
namespace RetailCrm\Factory;

use RetailCrm\Builder\ContainerBuilder;
use RetailCrm\Builder\TopClientBuilder;
use RetailCrm\Component\AppData;
use RetailCrm\TopClient\TopClient;

/**
 * Class TopClientFactory
 *
 * @category TopClientFactory
 * @package  RetailCrm\Factory
 */
class TopClientFactory
{
    /**
     * Create new TopClient
     *
     * @param string $baseUrl
     * @param string $token
     *
     * @return \RetailCrm\TopClient\TopClient
     * @throws \RetailCrm\Component\Exception\ValidationException
     */
    public static function createClient(
        string $baseUrl,
        string $token
    ): TopClient {
        $appData = new AppData($baseUrl, $token);
        $builder = TopClientBuilder::create()
            ->setContainer(ContainerBuilder::create()->build())
            ->setAppData($appData);

        return $builder->build();
    }
}
