<?php

namespace SkeletonPriceHistory\Services;

use SkeletonPriceHistory\DTO\PriceHistory;
use SkeletonPriceHistory\DTO\ProductUpdated;
use SkeletonPriceHistory\Models\PriceHistoryModel;

final class PriceHistoryService
{
    public function productUpdated(ProductUpdated $dto): void
    {
        $priceHistoryModel = new PriceHistoryModel();

        $priceHistory = PriceHistory::fromProductUpdatedDto($dto);

        if (!$priceHistoryModel->isModified($priceHistory)) {
            return;
        }

        $priceHistoryModel->insert($priceHistory);
    }
}
