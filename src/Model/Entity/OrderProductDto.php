<?php
/**
 * PHP version 7.3
 *
 * @category OrderProductDto
 * @package  Simla\Model\Entity
 */

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class OrderProductDto
 *
 * @category OrderProductDto
 * @package  Simla\Model\Entity
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
     * @var PromotionDto[] $promotions
     *
     * @JMS\Type("array<Simla\Model\Entity\PromotionDto>")
     * @JMS\SerializedName("promotions")
     */
    public $promotions;
}
