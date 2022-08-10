<?php

namespace Simla\Model\Response\Data;

use JMS\Serializer\Annotation as JMS;
use Simla\Model\Entity\OrderDto;

class GetOrderListResponseData
{
    /**
     * @var string $totalCount
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("total_count")
     */
    public $totalCount;

    /**
     * @var OrderDto[] $orders
     *
     * @JMS\Type("array<Simla\Model\Entity\OrderDto>")
     * @JMS\SerializedName("orders")
     */
    public $orders;
}
