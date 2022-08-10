<?php

/**
 * PHP version 7.3
 *
 * @category BaseRequest
 * @package  Simla\Model\Request
 */
namespace Simla\Model\Request;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use Simla\Component\Validator\Constraints as TopAssert;

/**
 * Class BaseRequest
 *
 * @category BaseRequest
 * @package  Simla\Model\Request
 */
abstract class BaseRequest
{
    /**
     * @var string $method
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("method")
     * @JMS\Accessor(getter="getMethod", setter="setMethod")
     * @JMS\ReadOnly()
     * @JMS\Exclude()
     * @Assert\NotBlank()
     */
    protected $method;

    /**
     * @var \DateTime $timestamp
     *
     * @JMS\Type("DateTime<'Y-m-d H:i:s'>")
     * @JMS\SerializedName("timestamp")
     * @Assert\NotBlank()
     * @TopAssert\Timezone("Asia/Shanghai")
     */
    public $timestamp;

    /**
     * BaseRequest constructor.
     */
    public function __construct()
    {
        $this->method = $this->getMethod();
    }

    /**
     * @param string $method
     *
     * @return void
     */
    final public function setMethod(string $method): void
    {
    }

    /**
     * Should return method name for this request.
     *
     * @return string
     */
    abstract public function getMethod(): string;

    /**
     * Should return response class FQN for this particular request.
     *
     * @return string
     */
    abstract public function getExpectedResponse(): string;
}
