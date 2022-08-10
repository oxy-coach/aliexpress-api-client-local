<?php

/**
 * PHP version 7.3
 *
 * @category ClientFactoryTest
 * @package  Simla\Tests\Factory
 */
namespace RetailCrm\Tests\Factory;

use Simla\Component\AppData;
use Simla\Component\Exception\ValidationException;
use Simla\Factory\ClientFactory;
use RetailCrm\Test\TestCase;

/**
 * Class ClientFactoryTest
 *
 * @category ClientFactoryTest
 * @package  Simla\Tests\Factory
 */
class ClientFactoryTest extends TestCase
{
    public function testCreateClient(): void
    {
        $client = ClientFactory::createClient(
            AppData::ENDPOINT,
            'token'
        );

        self::assertNotEmpty($client);
    }

    public function testCreateClientException(): void
    {
        $this->expectException(ValidationException::class);
        ClientFactory::createClient('https://example.com', 'token');
    }
}
