<?php

namespace SkeletonPriceHistory\DTO;

use SkeletonPriceHistory\Helpers\PriceHistoryHelper;

final class PriceHistory
{
    /**
     *
     * @var int 
     */
    public $productId;

    /**
     *
     * @var int|null 
     */
    public $variantId;

    /**
     *
     * @var float 
     */
    public $price;

    /**
     *
     * @var string
     */
    public $appliedDate;

    /**
     *
     * @var string|null
     */
    public $createdAt;

    public function __construct(int $productId, ?int $variantId, float $price, string $appliedDate, ?string $createdAt = null)
    {
        $this->productId = $productId;

        $this->variantId = $variantId;

        $this->price = $price;

        $this->appliedDate = $appliedDate;

        $this->createdAt = $createdAt;
    }

    public static function fromProductUpdatedDto(ProductUpdated $dto): PriceHistory
    {
        return new self(
            $dto->productId,
            ($dto->productWithVariants) ? $dto->variantId : null,
            ($dto->sale) ? $dto->salePrice : $dto->price,
            ($dto->sale && !\is_null($dto->saleStartDate)) ? $dto->saleStartDate : PriceHistoryHelper::nowDate()
        );
    }
}
