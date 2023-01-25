<?php

namespace SkeletonPriceHistory\Builders;

use SkeletonPriceHistory\Exceptions\PriceHistoryException;
use SkeletonPriceHistory\Helpers\PriceHistoryHelper;
use SkeletonPriceHistory\Models\PriceHistoryModel;

final class ProductMinPriceBuilder
{
    /**
     *
     * @var int 
     */
    private $itemId;

    /**
     *
     * @var bool 
     */
    private $productWithVariants;

    /**
     *
     * @var int 
     */
    private $lastDaysCout;

    /**
     *
     * @var float|null
     */
    private $minPrice = null;

    public function __construct(int $itemId, bool $productWithVariants, int $lastDaysCout = 30)
    {
        $this->itemId = $itemId;

        $this->productWithVariants = $productWithVariants;

        $this->lastDaysCout = $lastDaysCout;
    }

    public function initMinPrice(float $defaultPrice): void
    {
        $dateFrom = PriceHistoryHelper::subDate($this->lastDaysCout);

        $this->minPrice = ($this->productWithVariants)
            ? (new PriceHistoryModel())->minPriceByVariantFromDate($this->itemId, $dateFrom, $defaultPrice)
            : (new PriceHistoryModel())->minPriceByProductFromDate($this->itemId, $dateFrom, $defaultPrice);
    }

    public function getMinPrice(): float
    {
        if(\is_null($this->minPrice)){
            throw new PriceHistoryException("Min price does not inited");
        }

        return $this->minPrice;
    }
}
