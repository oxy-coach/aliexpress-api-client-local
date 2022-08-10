<?php

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class LogisticOrderLineDto
 *
 * @category LogisticOrderLineDto
 * @package  Simla\Model\Entity
 */
class LogisticOrderLineDto
{
    /**
     * @var int $skuId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("sku_id")
     */
    public $skuId;

    /**
     * @var int $quantity
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("quantity")
     */
    public $quantity;
}
