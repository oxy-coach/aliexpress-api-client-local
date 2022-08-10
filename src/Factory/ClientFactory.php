<?php

/**
 * PHP version 7.3
 *
 * @category ClientFactory
 * @package  Simla\Factory
 */
namespace Simla\Factory;

use Simla\Builder\ContainerBuilder;
use Simla\Builder\ClientBuilder;
use Simla\Component\AppData;
use Simla\Component\Exception\ValidationException;
use Simla\Client\Client;

/**
 * Class ClientFactory
 *
 * @category ClientFactory
 * @package  Simla\Factory
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
     * @throws ValidationException
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
