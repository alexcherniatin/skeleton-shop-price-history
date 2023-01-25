<?php

namespace SkeletonPriceHistory\DTO;

final class ProductUpdated
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
     * @var float 
     */
    public $salePrice;

    /**
     *
     * @var bool 
     */
    public $sale;

    /**
     *
     * @var bool 
     */
    public $productWithVariants;

    /**
     *
     * @var string|null 
     */
    public $saleStartDate;

    public function __construct(int $productId, ?int $variantId, float $price, float $salePrice, bool $sale, bool $productWithVariants, ?string $saleStartDate)
    {
        $this->productId = $productId;

        $this->variantId = $variantId;

        $this->price = $price;

        $this->salePrice = $salePrice;

        $this->sale = $sale;

        $this->productWithVariants = $productWithVariants;

        $this->saleStartDate = $saleStartDate;
    }
}
