<?php

/**
 * PHP version 7.3
 *
 * @category AppData
 * @package  Simla\Component
 */
namespace Simla\Component;

use Simla\Interfaces\AppDataInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AppData
 *
 * @category AppData
 * @package  Simla\Component
 */
class AppData implements AppDataInterface
{
    public const ENDPOINT = 'https://openapi.aliexpress.ru';
    public const AVAILABLE_ENDPOINTS = [self::ENDPOINT];

    /**
     * @var string $baseUrl
     * @Assert\Url()
     * @Assert\Choice(choices=AppData::AVAILABLE_ENDPOINTS, message="Invalid endpoint provided.")
     */
    protected $baseUrl;

    /**
     * @var string $token
     * @Assert\NotBlank()
     */
    private $token;

    /**
     * AppData constructor.
     *
     * @param string $baseUrl
     * @param string $token
     */
    public function __construct(string $baseUrl, string $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token   = $token;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
