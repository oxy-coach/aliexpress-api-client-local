<?php

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class PreSplitPostingDto
 *
 * @category PreSplitPostingDto
 * @package  Simla\Model\Entity
 */
class PostingLineDto extends BaseProductDto
{
    /**
     * @var int $orderLineId
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("order_line_id")
     */
    public $orderLineId;
}
