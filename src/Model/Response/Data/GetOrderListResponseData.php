<?php

namespace RetailCrm\Model\Response\Data;

use JMS\Serializer\Annotation as JMS;

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
     * @var \RetailCrm\Model\Entity\OrderDto[] $orders
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\OrderDto>")
     * @JMS\SerializedName("orders")
     */
    public $orders;
}
