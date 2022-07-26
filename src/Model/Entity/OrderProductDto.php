<?php
/**
 * PHP version 7.3
 *
 * @category OrderProductDto
 * @package  RetailCrm\Model\Entity
 */

namespace RetailCrm\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class OrderProductDto
 *
 * @category OrderProductDto
 * @package  RetailCrm\Model\Entity
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class OrderProductDto extends BaseProductDto
{
    /**
     * @var int $totalAmount
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("total_amount")
     */
    public $totalAmount;

    /**
     * @var string $issueStatus
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("issue_status")
     */
    public $issueStatus;

    /**
     * @var \RetailCrm\Model\Entity\PromotionDto[] $promotions
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\PromotionDto>")
     * @JMS\SerializedName("promotions")
     */
    public $promotions;
}
