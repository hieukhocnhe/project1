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

function getProductByName($name)
{
    try {
        $sql = "SELECT * FROM
        products
        WHERE
        name = '$name';";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function insertProduct($name, $price, $image, $quantity_in_stock, $quantity_in_batch)
{
    try {
        $sql = "INSERT INTO products(name, price, image, quantity_in_stock, quantity_in_batch) 
        VALUES ('$name','$price', '$image', '$quantity_in_stock', '$quantity_in_batch');";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function insertProductByBatchId($name, $price, $image, $quantity_in_stock, $quantity_in_batch, $batch_id)
{
    try {
        $sql = "INSERT INTO products(name, price, image, quantity_in_stock, quantity_in_batch, batch_id) 
        VALUES ('$name','$price', '$image', '$quantity_in_stock', '$quantity_in_batch', '$batch_id');";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function delProduct($id)
{
    try {
        $sql = "DELETE FROM products WHERE id = $id";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

?>