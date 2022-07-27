<?php

namespace RetailCrm\Model\Enum;

class DeliveryStatuses
{
    public const INIT = 'Init';
    public const PARTIAL_SHIPPED = 'PartialShipped';
    public const SHIPPED = 'Shipped';
    public const DELIVERED = 'Delivered';
    public const CANCELLED = 'Cancelled';

    // List of all statuses.
    public const STATUSES_LIST = [
        self::INIT,
        self::PARTIAL_SHIPPED,
        self::SHIPPED,
        self::DELIVERED,
        self::CANCELLED,
    ];
}
