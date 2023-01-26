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

    public static function fromProduct(array $product): PriceHistory
    {
        return new self(
            $product['id'],
            null,
            ($product['sale'] == 1) ? $product['sale_price'] : $product['price'],
            ($product['sale'] == 1 && !\is_null($product['sale_start_date'] ?? null)) ? $product['sale_start_date'] : PriceHistoryHelper::nowDate()
        );
    }

    public static function fromVariant(array $variant): PriceHistory
    {
        return new self(
            $variant['product_id'],
            $variant['id'],
            ($variant['sale'] == 1) ? $variant['sale_price'] : $variant['price'],
            ($variant['sale'] == 1 && !\is_null($variant['sale_start_date'] ?? null)) ? $variant['sale_start_date'] : PriceHistoryHelper::nowDate()
        );
    }
}
