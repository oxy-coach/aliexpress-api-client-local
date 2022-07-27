<?php

namespace RetailCrm\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class PreSplitPostingDto
 *
 * @category PreSplitPostingDto
 * @package  RetailCrm\Model\Entity
 */
class PreSplitPostingDto
{
    /**
     * @var int $id
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("id")
     */
    public $id;

    /**
     * @var int $deliveryFee
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("delivery_fee")
     */
    public $deliveryFee;

    /**
     * @var string $firstMileType
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("first_mile_type")
     */
    public $firstMileType;

    /**
     * @var \RetailCrm\Model\Entity\PostingLineDto[] $postingLines
     *
     * @JMS\Type("array<RetailCrm\Model\Entity\PostingLineDto>")
     * @JMS\SerializedName("posting_lines")
     */
    public $postingLines;
}
