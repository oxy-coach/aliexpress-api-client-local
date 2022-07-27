<?php

namespace RetailCrm\Model\Response;

use JMS\Serializer\Annotation as JMS;

/**
 * Class GetOrderListResponse
 *
 * @category GetOrderListResponse
 * @package  RetailCrm\Model\Response
 */
class GetOrderListResponse extends BaseResponse
{
    /**
     * @var \RetailCrm\Model\Response\Data\GetOrderListResponseData $responseData
     *
     * @JMS\Type("RetailCrm\Model\Response\Data\GetOrderListResponseData")
     * @JMS\SerializedName("data")
     */
    public $responseData;
}
