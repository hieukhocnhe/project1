<?php

function getAllProducts()
{
    try {
        $sql = "SELECT products.*, batches.manufacturing_date, batches.expiry_date, batches.batche_code
        FROM products
        JOIN batches ON products.batch_id = batches.id
        ORDER BY products.id ASC;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}





?>