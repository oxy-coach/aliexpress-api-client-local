<?php

namespace RetailCrm\Model\Request;

use JMS\Serializer\Annotation as JMS;
use RetailCrm\Component\Constants;
use RetailCrm\Model\Response\GetOrderListResponse;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GetOrderListRequest
 *
 * @category GetOrderListRequest
 * @package  RetailCrm\Model\Request
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class GetOrderListRequest extends BaseRequest
{
    /**
     * @var int $page
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("page")
     * @Assert\NotNull()
     */
    public $page = 1;

    /**
     * @var int $pageSize
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("page_size")
     * @Assert\NotNull()
     */
    public $pageSize = Constants::PAGE_SIZE;

    /**
     * @var string $dateStart
     *
     * Should be a datetime string in format <YYYY-MM-DDThh:mm:ssZ>
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("date_start")
     */
    public $dateStart;

    /**
     * @var string $dateEnd
     *
     * Should be a datetime string in format <YYYY-MM-DDThh:mm:ssZ>
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("date_end")
     */
    public $dateEnd;

    /**
     * @var string[] $orderStatuses
     *
     * @JMS\Type("array<string>")
     * @JMS\SerializedName("order_statuses")
     * @Assert\Choice(choices=RetailCrm\Model\Enum\OrderStatuses::STATUSES_LIST, multiple=true)
     */
    public $orderStatuses;

    /**
     * @var string[] $paymentStatuses
     *
     * @JMS\Type("array<string>")
     * @JMS\SerializedName("payment_statuses")
     * @Assert\Choice(choices=RetailCrm\Model\Enum\PaymentStatuses::STATUSES_LIST, multiple=true)
     */
    public $paymentStatuses;

    /**
     * @var string[] $deliveryStatuses
     *
     * @JMS\Type("array<string>")
     * @JMS\SerializedName("delivery_statuses")
     * @Assert\Choice(choices=RetailCrm\Model\Enum\DeliveryStatuses::STATUSES_LIST, multiple=true)
     */
    public $deliveryStatuses;

    /**
     * @var string[] $antifraudStatuses
     *
     * @JMS\Type("array<string>")
     * @JMS\SerializedName("antifraud_statuses")
     * @Assert\Choice(choices=RetailCrm\Model\Enum\AntifraudStatuses::STATUSES_LIST, multiple=true)
     */
    public $antifraudStatuses;

    /**
     * @var int[] $orderIds
     *
     * @JMS\Type("array<int>")
     * @JMS\SerializedName("order_ids")
     */
    public $orderIds;

    /**
     * @var string $sortingOrder
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("sorting_order")
     */
    public $sortingOrder;

    /**
     * @var string $sortingField
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("sorting_field")
     */
    public $sortingField;

    /**
     * @var string[] $trackingNumbers
     *
     * @JMS\Type("array<string>")
     * @JMS\SerializedName("tracking_numbers")
     */
    public $trackingNumbers;

    /**
     * @var string $updateAtFrom
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("update_at_from")
     */
    public $updateAtFrom;

    /**
     * @var string $updateAtTo
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("update_at_to")
     */
    public $updateAtTo;

    /**
     * @var string $shippingDayFrom
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("shipping_day_from")
     */
    public $shippingDayFrom;

    /**
     * @var string $shippingDayTo
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("shipping_day_to")
     */
    public $shippingDayTo;

    /**
     * @var string $tradeOrderInfo
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("trade_order_info")
     * @Assert\Choice(choices=RetailCrm\Model\Enum\OrderInfoFlags::LIST)
     */
    public $tradeOrderInfo;

    public function getMethod(): string
    {
        return '/seller-api/v1/order/get-order-list';
    }

    public function getExpectedResponse(): string
    {
        return GetOrderListResponse::class;
    }
}
