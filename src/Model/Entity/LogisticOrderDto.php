<?php

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class LogisticOrderDto
 *
 * @category LogisticOrderDto
 * @package  Simla\Model\Entity
 */
class LogisticOrderDto
{
    /**
     * @var int $id
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("id")
     */
    public $id;

    /**
     * @var int $tradeOrderId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("trade_order_id")
     */
    public $tradeOrderId;

    /**
     * @var string $trackNumber
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("track_number")
     */
    public $trackNumber;

    /**
     * @var string $status
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("status")
     */
    public $status;

    /**
     * @var CreationError $creationError
     *
     * @JMS\Type("Simla\Model\Entity\CreationError")
     * @JMS\SerializedName("creation_error")
     */
    public $creationError;

    /**
     * @var LogisticOrderLineDto[] $lines
     *
     * @JMS\Type("array<Simla\Model\Entity\LogisticOrderLineDto>")
     * @JMS\SerializedName("lines")
     */
    public $lines;
}
