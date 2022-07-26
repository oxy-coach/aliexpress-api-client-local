<?php
/**
 * PHP version 7.3
 *
 * @category LogisticsStatuses
 * @package  RetailCrm\Model\Enum
 */

namespace RetailCrm\Model\Enum;

/**
 * Class LogisticsStatuses
 *
 * @category LogisticsStatuses
 * @package  RetailCrm\Model\Enum
 */
class LogisticsStatuses
{
    public const NEW = 'New';

    public const AWAITING_CREATE_ORDER = 'AwaitingCreateOrder';

    public const ORDER_CREATION_PROBLEMS = 'OrderCreationProblems';

    public const AWAITING_HANDOVER_LIST = 'AwaitingHandoverList';

    public const ADDING_TO_HANDOVER_PROBLEMS = 'AddingToHandoverProblems';

    public const AWAITING_CONFIRMATION = 'AwaitingConfirmation';

    public const AWAITING_DISPATCH = 'AwaitingDispatch';

    public const ORDER_RECEIVED_FROM_SELLER = 'OrderReceivedFromSeller';

    public const CROSS_DOC_SORTING = 'CrossDocSorting';

    public const CROSS_DOC_SENT = 'CrossDocSent';

    public const PROVIDER_POSTING_RECEIVE = 'ProviderPostingReceive';

    public const PROVIDER_POSTING_LEFT_THE_RECEPTION = 'ProviderPostingLeftTheReception';

    public const PROVIDER_POSTING_ARRIVED_AT_SORTING = 'ProviderPostingArrivedAtSorting';

    public const PROVIDER_POSTING_SORTING = 'ProviderPostingSorting';

    public const PROVIDER_POSTING_LEFT_THE_SORTING = 'ProviderPostingLeftTheSorting';

    public const PROVIDER_POSTING_ARRIVED = 'ProviderPostingArrived';

    public const PROVIDER_POSTING_DELIVERED = 'ProviderPostingDelivered';

    public const PROVIDER_POSTING_UNSUCCESSFUL_ATTEMPT_OF_DELIVERY = 'ProviderPostingUnsuccessfulAttemptOfDelivery';

    public const PROVIDER_POSTING_IN_RETURN = 'ProviderPostingInReturn';

    public const PROVIDER_POSTING_TEMPORARY_STORAGE = 'ProviderPostingTemporaryStorage';

    public const PROVIDER_POSTING_RETURNED = 'ProviderPostingReturned';

    public const REJECTED = 'Rejected';

    public const CANCELLED = 'Cancelled';

    // All logistics statuses
    public const LOGISTICS_STATUSES = [
        self::NEW,
        self::AWAITING_CREATE_ORDER,
        self::ORDER_CREATION_PROBLEMS,
        self::AWAITING_HANDOVER_LIST,
        self::ADDING_TO_HANDOVER_PROBLEMS,
        self::AWAITING_CONFIRMATION,
        self::AWAITING_DISPATCH,
        self::ORDER_RECEIVED_FROM_SELLER,
        self::CROSS_DOC_SORTING,
        self::CROSS_DOC_SENT,
        self::PROVIDER_POSTING_RECEIVE,
        self::PROVIDER_POSTING_LEFT_THE_RECEPTION,
        self::PROVIDER_POSTING_ARRIVED_AT_SORTING,
        self::PROVIDER_POSTING_SORTING,
        self::PROVIDER_POSTING_LEFT_THE_SORTING,
        self::PROVIDER_POSTING_ARRIVED,
        self::PROVIDER_POSTING_DELIVERED,
        self::PROVIDER_POSTING_UNSUCCESSFUL_ATTEMPT_OF_DELIVERY,
        self::PROVIDER_POSTING_IN_RETURN,
        self::PROVIDER_POSTING_TEMPORARY_STORAGE,
        self::PROVIDER_POSTING_RETURNED,
        self::REJECTED,
        self::CANCELLED,
    ];
}
