<?php

/**
 * PHP version 7.3
 *
 * @category FileLogger
 * @package  Simla\Component\Logger
 */
namespace Simla\Component\Logger;

/**
 * Class FileLogger
 *
 * @category FileLogger
 * @package  Simla\Component\Logger
 */
class FileLogger extends AbstractLogger
{
    /** @var string $ */
    private $fileName;

    /**
     * FileLogger constructor.
     *
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     */
    public function log($level, $message, array $context = [])
    {
        error_log($this->formatMessage($level, $message, $context), 3, $this->fileName);
    }
}
