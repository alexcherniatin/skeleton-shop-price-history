<?php

namespace SkeletonPriceHistory\Services;

use SkeletonPriceHistory\DTO\PriceHistory;
use SkeletonPriceHistory\DTO\ProductUpdated;
use SkeletonPriceHistory\Helpers\PriceHistoryHelper;
use SkeletonPriceHistory\Models\PriceHistoryModel;

final class PriceHistoryService
{
    public function productUpdated(ProductUpdated $dto): void
    {
        (new PriceHistoryModel())->insert(
            new PriceHistory(
                $dto->productId,
                ($dto->productWithVariants) ? $dto->variantId : null,
                ($dto->sale) ? $dto->salePrice : $dto->price,
                ($dto->sale && !\is_null($dto->saleStartDate)) ? $dto->saleStartDate : PriceHistoryHelper::nowDate()
            )
        );
    }
}
