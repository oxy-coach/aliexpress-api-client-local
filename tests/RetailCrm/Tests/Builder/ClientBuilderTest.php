<?php

/**
 * PHP version 7.4
 *
 * @category ClientBuilderTest
 * @package  Simla\Tests\Builder
 */
namespace RetailCrm\Tests\Builder;

use Simla\Component\AppData;
use Simla\Builder\ClientBuilder;
use RetailCrm\Test\TestCase;
use Simla\Client\Client;

/**
 * Class ClientBuilderTest
 *
 * @category ClientBuilderTest
 * @package  Simla\Tests\Builder
 */
class ClientBuilderTest extends TestCase
{
    public function testCreateClient()
    {
        $client = ClientBuilder::create()
            ->setContainer($this->getContainer())
            ->setAppData(new AppData(AppData::ENDPOINT, 'token'))
            ->build();

        self::assertInstanceOf(Client::class, $client);
    }
}
