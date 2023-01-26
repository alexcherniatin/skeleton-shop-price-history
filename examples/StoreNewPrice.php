<?php

//after updating product

\SkeletonPriceHistory\Actions\AddProductPriceHistory::execute(
    \SkeletonPriceHistory\DTO\PriceHistory::fromProduct($product)
);

//after updating variant

\SkeletonPriceHistory\Actions\AddProductPriceHistory::execute(
    \SkeletonPriceHistory\DTO\PriceHistory::fromVariant($variant)
);

//product builder component

private function minimalMonthPrice(): void
{
    if (!ProductHelper::isSale($this->product)) {
        $this->components['minimalMonthPrice'] = '';
        return;
    }

    $minPriceBuilder = new \SkeletonPriceHistory\Builders\ProductMinPriceBuilder(
        $this->variant['id'] ?? $this->product['id'],
        ($this->product['type'] == ProductHelper::PRODUCT_TYPE_VARIANT),
        30
    );

    $minPriceBuilder->initMinPrice($this->product['sale_price']);

    $this->components['minimalMonthPrice'] = '
    <div class="minimal-month-price">
        <p>' . _("Najniższa cena z 30 dni przed obniżką:") . ' ' . ShopHelper::priceWithCurrency($minPriceBuilder->getMinPrice()) . '</p>
    </div>
    ';
}

//update component after chaning variant state in variant.js

$('.component-minimal-month-price').html(data.minimalMonthPrice);