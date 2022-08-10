<?php

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class PreSplitPostingDto
 *
 * @category PreSplitPostingDto
 * @package  Simla\Model\Entity
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
     * @var PostingLineDto[] $postingLines
     *
     * @JMS\Type("array<Simla\Model\Entity\PostingLineDto>")
     * @JMS\SerializedName("posting_lines")
     */
    public $postingLines;
}
