<?php

namespace SkeletonPriceHistory\Helpers;

use DateInterval;
use DateTime;

final class PriceHistoryHelper
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    public static function nowDate(): string
    {
        return (new DateTime())->format(self::DATE_FORMAT);
    }

    public static function subDate(int $days): string
    {
        return (new DateTime())->sub(new DateInterval('P' . $days . 'D'))->format(self::DATE_FORMAT);
    }
}