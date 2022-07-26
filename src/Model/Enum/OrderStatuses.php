<?php
/**
 * PHP version 7.3
 *
 * @category OrderStatuses
 * @package  RetailCrm\Model\Enum
 */

namespace RetailCrm\Model\Enum;

/**
 * Class OrderStatuses
 *
 * @category OrderStatuses
 * @package  RetailCrm\Model\Enum
 */
class OrderStatuses
{
    // Order was just created.
    public const CREATED = 'Created';

    // Order is in progress.
    public const IN_PROGRESS = 'InProgress';

    // Order is closed, no further actions needed.
    public const FINISHED = 'Finished';

    // Buyer requested cancellation.
    public const CANCELLED = 'Cancelled';

    // List of all order statuses.
    public const STATUSES_LIST = [
        self::CREATED,
        self::IN_PROGRESS,
        self::FINISHED,
        self::CANCELLED,
    ];
}
