## After updating product
```php
\SkeletonPriceHistory\Actions\AddProductPriceHistory::execute(
    \SkeletonPriceHistory\DTO\PriceHistory::fromProduct($product)
);
```
## After updating variant
```php
\SkeletonPriceHistory\Actions\AddProductPriceHistory::execute(
    \SkeletonPriceHistory\DTO\PriceHistory::fromVariant($variant)
);
```
## Product builder component
```php
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
```
## Update component after chaning variant state in variant.js
```js
$('.component-minimal-month-price').html(data.minimalMonthPrice);
```