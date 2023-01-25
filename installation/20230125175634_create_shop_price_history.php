<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateShopPriceHistory extends AbstractMigration
{
    public function up(): void
    {
        $table = $this->table('shop_price_history');

        $table
            ->addColumn('product_id', 'integer')
            ->addColumn('variant_id', 'integer', ['null' => true])
            ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('applied_date', 'datetime')
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('product_id', 'shop_product', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('variant_id', 'shop_variant', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->save();
    }

    public function down(): void
    {
        $this->table('shop_price_history')->drop()->save();
    }
}
