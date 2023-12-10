<?php

function getAllProducts()
{
    try {
        $sql = "SELECT * FROM products;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

function getProductByName($name)
{
    try {
        $sql = "SELECT * FROM products WHERE name = '$name';";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


function insertProduct($name, $price, $image, $quantity_in_stock, $manufacturing_date, $expiry_date, $unit)
{
    try {
        $sql = "INSERT INTO products(name, price, image, quantity_in_stock, manufacturing_date, expiry_date, unit) 
        VALUES ('$name', '$price', '$image', '$quantity_in_stock', '$manufacturing_date', '$expiry_date', '$unit');";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function insertProductByBatchId($name, $price, $image, $quantity_in_stock, $quantity_in_batch, $batch_id)
{
    try {
        $sql = "INSERT INTO products(name, price, image, quantity_in_stock, quantity_in_batch, batch_id) 
        VALUES ('$name', '$price', '$image', '$quantity_in_stock', '$quantity_in_batch', '$batch_id');";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function editProduct($name, $price, $image, $quantity_in_stock, $quantity_in_batch, $manufacturing_date, $expiry_date, $batch_id, $id)
{
    try {
        $sql = "UPDATE products
                SET
                    name = '$name',
                    price = '$price',
                    image = '$image',
                    quantity_in_stock = '$quantity_in_stock',
                    quantity_in_batch = '$quantity_in_batch',
                    manufacturing_date = '$manufacturing_date',
                    expiry_date = '$expiry_date',
                    batch_id = $batch_id
                WHERE
                    id = $id;";
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

function getProductDetailByProductId($id)
{
    try {
        $sql = "SELECT 
                    products.id AS product_id, products.name AS product_name, products.price AS product_price,
                    products.image AS product_image, products.quantity_in_stock AS product_quantity_in_stock,
                    products.quantity_in_batch AS product_quantity_in_batch,
                    batches.id AS batch_id, batches.batche_code,
                    batches.manufacturing_date AS batch_manufacturing_date,
                    batches.expiry_date AS batch_expiry_date
                FROM 
                    products
                JOIN 
                    batch_products ON products.id = batch_products.product_id
                JOIN 
                    batches ON batch_products.batch_id = batches.id
                WHERE 
                    products.id = $id;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

?>