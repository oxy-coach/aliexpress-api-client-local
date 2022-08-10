<?php

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class PromotionDto
 *
 * @category PromotionDto
 * @package  Simla\Model\Entity
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class PromotionDto
{
    /**
     * @var int $aePromotionId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("ae_promotion_id")
     */
    public $aePromotionId;

    /**
     * @var int $aeActivityId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("ae_activity_id")
     */
    public $aeActivityId;

    /**
     * @var string $code
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("code")
     */
    public $code;

    /**
     * @var string $promotionType
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("promotion_type")
     */
    public $promotionType;

    /**
     * @var int $discount
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("discount")
     */
    public $discount;

    /**
     * @var string $discountCurrency
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("discount_currency")
     */
    public $discountCurrency;

    /**
     * @var int $originalDiscount
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("original_discount")
     */
    public $originalDiscount;

    /**
     * @var string $originalDiscountCurrency
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("original_discount_currency")
     */
    public $originalDiscountCurrency;

    /**
     * @var string $promotionTarget
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("promotion_target")
     */
    public $promotionTarget;

    /**
     * @var string $budgetSponsor
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("budget_sponsor")
     */
    public $budgetSponsor;
}
