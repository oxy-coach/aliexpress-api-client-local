<?php

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class BaseProductDto
 *
 * @category BaseProductDto
 * @package  Simla\Model\Entity
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class BaseProductDto
{
    /**
     * @var int $id
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("id")
     */
    public $id;

    /**
     * @var string $itemId
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("item_id")
     */
    public $itemId;

    /**
     * @var string $skuId
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("sku_id")
     */
    public $skuId;

    /**
     * @var int $quantity
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("quantity")
     */
    public $quantity;

    /**
     * @var int $height
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("height")
     */
    public $height;

    /**
     * @var int $weight
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("weight")
     */
    public $weight;

    /**
     * @var int $width
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("width")
     */
    public $width;

    /**
     * @var int $length
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("length")
     */
    public $length;

    /**
     * @var string $name
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("name")
     */
    public $name;

    /**
     * @var string $imgUrl
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("img_url")
     */
    public $imgUrl;

    /**
     * @var int $itemPrice
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("item_price")
     */
    public $itemPrice;

    /**
     * @var string[] $properties
     *
     * @JMS\Type("array<string>")
     * @JMS\SerializedName("properties")
     */
    public $properties;

    /**
     * @var string $buyerComment
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("buyer_comment")
     */
    public $buyerComment;
}
