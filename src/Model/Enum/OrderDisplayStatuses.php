<?php

namespace Simla\Model\Enum;

class OrderDisplayStatuses
{
    public const UNKNOWN = 'Unknown';
    public const PLACE_ORDER_SUCCESS = 'PlaceOrderSuccess';
    public const PAYMENT_PENDING = 'PaymentPending';
    public const WAIT_EXAMINE_MONEY = 'WaitExamineMoney';
    public const WAIT_GROUP = 'WaitGroup';
    public const WAIT_SEND_GOOD = 'WaitSendGood';
    public const PARTIAL_SEND_GOODS = 'PartialSendGoods';
    public const WAIT_ACCEPT_GOODS = 'WaitAcceptGoods';
    public const IN_CANCEL = 'InCancel';
    public const COMPLETE = 'Complete';
    public const CLOSE = 'Close';
    public const FINISH = 'Finish';
    public const IN_FROZEN = 'InFrozen';
    public const IN_ISSUE = 'InIssue';

    public const LIST = [
        self::UNKNOWN,
        self::PLACE_ORDER_SUCCESS,
        self::PAYMENT_PENDING,
        self::WAIT_EXAMINE_MONEY,
        self::WAIT_GROUP,
        self::WAIT_SEND_GOOD,
        self::PARTIAL_SEND_GOODS,
        self::WAIT_ACCEPT_GOODS,
        self::IN_CANCEL,
        self::COMPLETE,
        self::CLOSE,
        self::FINISH,
        self::IN_FROZEN,
        self::IN_ISSUE,
    ];
}
