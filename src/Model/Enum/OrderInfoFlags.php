<?php

namespace Simla\Model\Enum;

class OrderInfoFlags
{
    // Flag for base order info
    public const COMMON = 'Common';

    // Flag for adding logistic info to response
    public const LOGISTIC_INFO = 'LogisticInfo';

    // List of all flags.
    public const LIST = [
        self::COMMON,
        self::LOGISTIC_INFO,
    ];
}
