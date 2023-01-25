<?php

namespace SkeletonPriceHistory\Models;

use Skeleton\Core\Model;
use SkeletonPriceHistory\DTO\PriceHistory;

final class PriceHistoryModel extends Model
{
    public function insert(PriceHistory $dto): int
    {
        $query = "INSERT INTO shop_price_history
        (product_id,variant_id,price,applied_date)
        VALUES
        (:product_id,:variant_id,:price,:applied_date)";
        $this->db->query($query);
        $this->db->bind(':product_id', $dto->productId);
        $this->db->bind(':variant_id', $dto->variantId);
        $this->db->bind(':price', $dto->price);
        $this->db->bind(':applied_date', $dto->appliedDate);
        $result = $this->db->execute();
        return ($result) ? $this->db->lastInsertId() : 0;
    }

    public function isModified(PriceHistory $dto): bool
    {
        $query = 'SELECT price
        FROM shop_price_history
        WHERE product_id = :product_id ';

        if (\is_null($dto->variantId)) {
            $query .= ' AND variant_id IS NULL';
        } else {
            $query .= ' AND variant_id = :variant_id';
        }

        $query .= ' 
        ORDER BY id DESC
        LIMIT 1';

        $this->db->query($query);
        $this->db->bind(':product_id', $dto->productId);
        if (!\is_null($dto->variantId)) {
            $this->db->bind(':variant_id', $dto->variantId);
        }
        $result = $this->db->result();

        if (!$result) {
            return true;
        }

        return $result['price'] != $dto->price;
    }

    public function minPriceByProductFromDate(int $productId, string $date, float $defaultValue = 0): float
    {
        $query = "SELECT min(price) as min_price
        FROM shop_price_history
        WHERE product_id = :product_id AND applied_date > :date
        LIMIT 1";
        $this->db->query($query);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':date', $date);
        $result = $this->db->result();
        return ($result) ? $result['min_price'] : $defaultValue;
    }

    public function minPriceByVariantFromDate(int $variantId, string $date, float $defaultValue = 0): float
    {
        $query = "SELECT min(price) as min_price
        FROM shop_price_history
        WHERE variant_id = :variant_id AND applied_date > :date
        LIMIT 1";
        $this->db->query($query);
        $this->db->bind(':variant_id', $variantId);
        $this->db->bind(':date', $date);
        $result = $this->db->result();
        return ($result) ? $result['min_price'] : $defaultValue;
    }
}
