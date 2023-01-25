<?php

namespace SkeletonPriceHistory\DTO;

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
     * @var string|null
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
}
