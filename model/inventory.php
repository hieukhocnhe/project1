<?php

function getInventoryByProductId($product_id)
{
    try {
        $sql = "SELECT 
                    i.id AS inventory_id,
                    i.product_id AS product_id,
                    i.stockdate AS stockdate,
                    i.quantity AS quantity,
                    i.transaction_type AS transaction_type,
                    t.transaction_code AS transaction_code,
                    i.storage_area_id AS storage_area_id,
                    i.created_at AS created_at,
                    s.area_name AS area_name,
                    p.name AS product_name
                FROM inventory i
                LEFT JOIN transactions t ON i.transaction_id = t.id
                LEFT JOIN storage_areas s ON i.storage_area_id = s.id
                LEFT JOIN products p ON i.product_id = p.id
                WHERE i.product_id = $product_id;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}



?>