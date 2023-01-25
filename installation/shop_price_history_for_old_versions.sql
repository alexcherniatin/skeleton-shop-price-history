CREATE TABLE `shop_price_history` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `applied_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `shop_price_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);


ALTER TABLE `shop_price_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `shop_price_history`
  ADD CONSTRAINT `shop_price_history_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shop_price_history_ibfk_2` FOREIGN KEY (`variant_id`) REFERENCES `shop_variant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

