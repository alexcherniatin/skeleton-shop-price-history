<?php

namespace SkeletonPriceHistory\Actions;

use SkeletonPriceHistory\DTO\PriceHistory;
use SkeletonPriceHistory\Models\PriceHistoryModel;

final class AddProductPriceHistory
{
    public static function execute(PriceHistory $priceHistory): void
    {
        $priceHistoryModel = new PriceHistoryModel();

        if (!$priceHistoryModel->isModified($priceHistory)) {
            return;
        }

        $priceHistoryModel->insert($priceHistory);
    }
}
