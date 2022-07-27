<?php

/**
 * PHP version 7.4
 *
 * @category ClientBuilderTest
 * @package  RetailCrm\Tests\Builder
 */
namespace RetailCrm\Tests\Builder;

use RetailCrm\Component\AppData;
use RetailCrm\Builder\ClientBuilder;
use RetailCrm\Test\TestCase;
use RetailCrm\Client\Client;

/**
 * Class ClientBuilderTest
 *
 * @category ClientBuilderTest
 * @package  RetailCrm\Tests\Builder
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
