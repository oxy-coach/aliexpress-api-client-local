<?php

namespace RetailCrm\Model\Enum;

class AntifraudStatuses
{
    public const NOT_CHECKED = 'NotChecked';
    public const CHECKING = 'Checking';
    public const BLOCKED = 'Blocked';
    public const PASSED = 'Passed';

    // List of all statuses.
    public const STATUSES_LIST = [
        self::NOT_CHECKED,
        self::CHECKING,
        self::BLOCKED,
        self::PASSED,
    ];
}
