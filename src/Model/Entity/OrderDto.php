<?php
/**
 * PHP version 7.3
 *
 * @category OrderDto
 * @package  RetailCrm\Model\Entity
 */

namespace RetailCrm\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class OrderDto
 *
 * @category OrderDto
 * @package  RetailCrm\Model\Entity
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class OrderDto
{
    /**
     * @var string $id
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("id")
     */
    public $id;

    /**
     * @var string $createdAt
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("created_at")
     */
    public $createdAt;

    /**
     * @var string $paidAt
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("paid_at")
     */
    public $paidAt;

    /**
     * @var string $updatedAt
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("updated_at")
     */
    public $updatedAt;

    /**
     * @var string $status
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("status")
     */
    public $status;

    /**
     * @var string $paymentStatus
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("payment_status")
     */
    public $paymentStatus;

    /**
     * @var string $deliveryStatus
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("delivery_status")
     */
    public $deliveryStatus;

    /**
     * @var string $deliveryAddress
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("delivery_address")
     */
    public $deliveryAddress;

    /**
     * @var string $antifraudStatus
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("antifraud_status")
     */
    public $antifraudStatus;

    /**
     * @var string $buyerCountryCode
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("buyer_country_code")
     */
    public $buyerCountryCode;

    /**
     * @var string $buyerName
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("buyer_name")
     */
    public $buyerName;

    /**
     * @var string $orderDisplayStatus
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("order_display_status")
     */
    public $orderDisplayStatus;

    /**
     * @var string $buyerPhone
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("buyer_phone")
     */
    public $buyerPhone;

    /**
     * @var \RetailCrm\Model\Entity\OrderProductDto[] $orderLines
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\OrderProductDto>")
     * @JMS\SerializedName("order_lines")
     */
    public $orderLines;

    /**
     * @var int $totalAmount
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("total_amount")
     */
    public $totalAmount;

    /**
     * @var string $sellerComment
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("seller_comment")
     */
    public $sellerComment;

    /**
     * @var bool $fullyPrepared
     *
     * @JMS\Type("bool")
     * @JMS\SerializedName("fully_prepared")
     */
    public $fullyPrepared;

    /**
     * @var string $finishReason
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("finish_reason")
     */
    public $finishReason;

    /**
     * @var string $cutOffDate
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("cut_off_date")
     */
    public $cutOffDate;

    /**
     * @var \RetailCrm\Model\Entity\CutOffDateDto[] $cutOffDateHistories
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\CutOffDateDto>")
     * @JMS\SerializedName("cut_off_date_histories")
     */
    public $cutOffDateHistories;

    /**
     * @var string $shippingDeadline
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("shipping_deadline")
     */
    public $shippingDeadline;

    /**
     * @var string $nextCutOffDate
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("next_cut_off_date")
     */
    public $nextCutOffDate;

    /**
     * @var \RetailCrm\Model\Entity\PreSplitPostingDto[] $preSplitPostings
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\PreSplitPostingDto>")
     * @JMS\SerializedName("pre_split_postings")
     */
    public $preSplitPostings;

    /**
     * @var \RetailCrm\Model\Entity\LogisticOrderDto[] $logisticOrders
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\LogisticOrderDto>")
     * @JMS\SerializedName("logistic_orders")
     */
    public $logisticOrders;

    /**
     * @var \RetailCrm\Model\Entity\CommissionDto $commission
     *
     * @JMS\Type("RetailCrm\Model\Entity\CommissionDto")
     * @JMS\SerializedName("commission")
     */
    public $commission;
}
