<?php

namespace RetailCrm\Model\Enum;

class PaymentStatuses
{
    // Order is not paid.
    public const NOT_PAID = 'NotPaid';

    // Payment was blocked by the bank.
    public const HOLD = 'Hold';

    // Order was paid.
    public const PAID = 'Paid';

    // Payment was cancelled.
    public const CANCELLED = 'Cancelled';

    // Errors with payment.
    public const FAILED = 'Failed';

    // List of all payment statuses.
    public const STATUSES_LIST = [
        self::NOT_PAID,
        self::HOLD,
        self::PAID,
        self::CANCELLED,
        self::FAILED,
    ];
}
