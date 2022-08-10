<?php

/**
 * PHP version 7.3
 *
 * @category TimestampProvider
 * @package  Simla\Service
 */
namespace Simla\Service;

use DateTime;
use DateTimeZone;
use Simla\Interfaces\RequestTimestampProviderInterface;
use Simla\Model\Request\BaseRequest;

/**
 * Class TimestampProvider
 *
 * @category TimestampProvider
 * @package  Simla\Service
 */
class RequestTimestampProvider implements RequestTimestampProviderInterface
{
    /**
     * Sets current timestamp in GMT +8 timezone in the request
     *
     * @param BaseRequest $request
     *
     * @return void
     */
    public function provide(BaseRequest $request): void
    {
        $request->timestamp = $this->getTimestamp();
    }

    /**
     * @return \DateTime
     */
    private function getTimestamp(): DateTime
    {
        if (function_exists('date_default_timezone_set')
            && function_exists('date_default_timezone_get')
        ) {
            date_default_timezone_set(date_default_timezone_get());
        }

        $timestamp = new DateTime();
        $timestamp->setTimezone(new DateTimeZone('Asia/Shanghai'));

        return $timestamp;
    }
}
