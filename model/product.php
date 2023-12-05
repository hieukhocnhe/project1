<?php

function getAllProducts()
{
    try {
        $sql = "SELECT
                    products.*,
                    MAX(batches.manufacturing_date) AS manufacturing_date_from_batche,
                    MAX(batches.expiry_date) AS expiry_date_from_batche,
                    MAX(batches.batche_code) AS batche_code
                FROM
                    products
                LEFT JOIN
                    batches ON products.batch_id = batches.id
                GROUP BY
                    products.id
                ORDER BY
                    products.id DESC
                LIMIT 10;";
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

?>