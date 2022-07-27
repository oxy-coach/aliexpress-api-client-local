<?php

namespace RetailCrm\Model\Entity;

use JMS\Serializer\Annotation as JMS;

class CreationError
{
    /**
     * @var string $code
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("code")
     */
    public $code;

    /**
     * @var string $description
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("description")
     */
    public $description;
}
