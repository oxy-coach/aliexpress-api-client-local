<?php

/**
 * PHP version 7.3
 *
 * @category RequestFactoryTest
 * @package  RetailCrm\Tests\Factory
 */
namespace RetailCrm\Tests\Factory;

use RetailCrm\Factory\RequestFactory;
use RetailCrm\Interfaces\RequestFactoryInterface;
use RetailCrm\Test\TestCase;

/**
 * Class RequestFactoryTest
 *
 * @category RequestFactoryTest
 * @package  RetailCrm\Tests\Factory
 */
class RequestFactoryTest extends TestCase
{
    public function testFromModelGet(): void
    {
        /** @var RequestFactory $factory */
        $factory = $this->getContainer()->get(RequestFactoryInterface::class);
        $request = $factory->fromModel(
            $this->getTestRequest(),
            $this->getAppData()
        );
        $contents = self::getStreamData($request->getBody());

        self::assertNotEmpty($contents);
        $content = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        self::assertEquals(20, $content['page_size']);
    }
}
