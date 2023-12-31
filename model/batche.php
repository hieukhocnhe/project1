<?php

function getAllProductByBatcheId($id)
{
    try {
        $sql = "SELECT 
                    batch_products.*,
                    products.id AS product_id,
                    products.name AS product_name,
                    products.price AS product_price,
                    products.image AS product_image,
                    products.quantity_in_stock AS product_quantity_in_stock,
                    products.quantity_in_batch AS product_quantity_in_batch,
                    products.manufacturing_date AS product_manufacturing_date,
                    products.expiry_date AS product_expiry_date,
                    batches.batche_code
                FROM 
                    batch_products
                JOIN 
                    products ON batch_products.product_id = products.id
                JOIN 
                    batches ON batch_products.batch_id = batches.id
                WHERE 
                    batch_products.batch_id = $id;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}
function getAllBatches()
{
    try {
        $sql = "SELECT 
        b.id, b.batche_code, su.id AS supplier_id, su.name AS supplier_name,
        sto.id AS storage_id, sto.area_name AS storage_name, stt.id AS status_id, stt.name AS status_name,
        b.manufacturing_date, b.expiry_date, b.created_at
        FROM batches b
        INNER JOIN suppliers su ON b.supplier_id = su.id
        INNER JOIN storage_areas sto ON b.storage_area_id = sto.id
        INNER JOIN batch_statuses stt ON b.status_id = stt.id
        GROUP BY b.id
        ORDER BY b.id ASC;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        $e->getMessage();
    }
}

function getAllBatchStatuses()
{
    try {
        $sql = "SELECT * FROM batch_statuses";
        return pdo_query($sql);
    } catch (\Exception $e) {
        $e->getMessage();
    }
}

function generateRandomString($length = 6)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    try {
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $max)];
        }

        return $randomString;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


function getLatestBatche()
{
    try {
        $sql = "SELECT * FROM batches ORDER BY id DESC LIMIT 1;";
        return pdo_query_one($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


// Hàm thêm lô hàng và trả về thông tin về lô hàng vừa thêm
function insertBatche($batche_code, $supplier_id, $storage_id, $manufacturing_date, $expiry_date, $created_at, $status_id)
{
    try {
        $batche_code = generateRandomString();
        $sql = "INSERT INTO batches (batche_code, supplier_id, storage_area_id, manufacturing_date, expiry_date, created_at, status_id)
        VALUES ('$batche_code', $supplier_id, $storage_id, '$manufacturing_date', '$expiry_date', '$created_at', $status_id)";
        pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getBatchById($batch_id)
{
    try {
        $sql = "SELECT * FROM batches WHERE id = $batch_id";
        return pdo_query_one($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


// Hàm thêm chi tiết lô hàng


function addBatchDetail($batch_id, $name)
{
    try {
        $product_id = getProductByName($name)['id'];
        $sql = "INSERT INTO batch_products(batch_id, product_id) VALUES ('$batch_id', '$product_id');";
        return pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function editBatche($id, $batche_code, $supplier_id, $storage_area_id, $manufacturing_date, $expiry_date, $status_id, $created_at)
{
    try {
        $sql = "UPDATE batches
                SET
                    batche_code = '$batche_code',
                    supplier_id = '$supplier_id',
                    storage_area_id = '$storage_area_id',
                    manufacturing_date = '$manufacturing_date',
                    expiry_date = '$expiry_date',
                    status_id = '$status_id',
                    created_at = '$created_at'
                WHERE
                    id = $id;";
        pdo_execute($sql);
    } catch (\Exception $e) {
        $e->getMessage();
    }
}



?>