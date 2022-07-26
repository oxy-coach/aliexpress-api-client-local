<?php

namespace RetailCrm\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class CommissionDto
 *
 * @category CommissionDto
 * @package  RetailCrm\Model\Entity
 */
class CommissionDto
{

    /**
     * @var int $platformFee
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("platform_fee")
     */
    public $platformFee;

    /**
     * @var int $affiliateFee
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("affiliate_fee")
     */
    public $affiliateFee;

    /**
     * @var int $estimateRevenue
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("estimate_revenue")
     */
    public $estimateRevenue;
}
