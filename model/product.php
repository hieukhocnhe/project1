<?php

function getAllProducts()
{
    try {
        $sql = "SELECT products.*, product_statuses.name AS status_name
                FROM products
                JOIN product_statuses ON products.status_id = product_statuses.id";
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


function insertProduct($name, $price, $image, $quantity_in_stock, $manufacturing_date, $expiry_date, $unit, $status_id)
{
    try {
        $sql = "INSERT INTO products(name, price, image, quantity_in_stock, manufacturing_date, expiry_date, unit, status_id)
        VALUES ('$name', '$price', '$image', '$quantity_in_stock', '$manufacturing_date', '$expiry_date', '$unit', '$status_id');";
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

function editProduct($name, $price, $image, $manufacturing_date, $expiry_date, $status_id, $unit, $id)
{
    try {
        $sql = "UPDATE products
                SET
                    name = '$name',
                    price = '$price',
                    image = '$image',
                    manufacturing_date = '$manufacturing_date',
                    expiry_date = '$expiry_date',
                    status_id = '$status_id',
                    unit = '$unit'
                WHERE
                    id = $id;";
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
                LEFT JOIN 
                    batch_products ON products.id = batch_products.product_id
                LEFT JOIN 
                    batches ON batch_products.batch_id = batches.id
                WHERE 
                    products.id = $id;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getAllProductStatuses()
{
    try {
        $sql = "SELECT * FROM product_statuses;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getQuantityInStockByProductId($product_id)
{
    try {
        $sql = "SELECT quantity_in_stock FROM products WHERE id = '$product_id';";
        return pdo_query_one($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getPriceByProductId($product_id)
{
    try {
        $sql = "SELECT price FROM products WHERE id = '$product_id';";
        return pdo_query_one($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

?>