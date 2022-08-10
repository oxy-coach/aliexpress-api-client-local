<?php

namespace Simla\Model\Entity;

use JMS\Serializer\Annotation as JMS;

/**
 * Class CutOffDateDto
 *
 * @category CutOffDateDto
 * @package  Simla\Model\Entity
 */
class CutOffDateDto
{
    /**
     * @var int $shiftNumber
     *
     * @JMS\Type("int")
     * @JMS\SerializedName("shift_number")
     */
    public $shiftNumber;

    /**
     * @var string $cutOffDate
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("cut_off_date")
     */
    public $cutOffDate;
}
