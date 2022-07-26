<?php

namespace RetailCrm\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class LogisticOrderDto
 *
 * @category LogisticOrderDto
 * @package  RetailCrm\Model\Entity
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
     * @var \RetailCrm\Model\Entity\CreationError $creationError
     *
     * @JMS\Type("RetailCrm\Model\Entity\CreationError")
     * @JMS\SerializedName("creation_error")
     */
    public $creationError;

    /**
     * @var \RetailCrm\Model\Entity\LogisticOrderLineDto[] $lines
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\LogisticOrderLineDto>")
     * @JMS\SerializedName("lines")
     */
    public $lines;
}
