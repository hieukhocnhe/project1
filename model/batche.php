<?php

function getAllProductByBatcheId($id)
{
    try {
        $sql = "SELECT products.*, batches.manufacturing_date, batches.expiry_date, batches.batche_code
        FROM products
        JOIN batches ON products.batch_id = batches.id
        WHERE batches.id = $id;";
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

function addBatche($batche_code, $supplier_id, $storage_area_id, $manufacturing_date, $expiry_date, $status_id)
{
    try {
        $batche_code = generateRandomString();
        $sql = "INSERT INTO batches (batche_code, supplier_id, storage_area_id, manufacturing_date, expiry_date, status_id)
        VALUES ('$batche_code', $supplier_id, $storage_area_id, '$manufacturing_date', '$expiry_date', $status_id)";
        return pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function addBatchDetail($batch_id, $name)
{
    try {
        $product_id = getProductByName($name)['id'];
        $sql = "INSERT INTO batch_products (batch_id, product_id) 
                VALUES ('$batch_id', '$product_id');";
        return pdo_execute($sql);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function deleteBatche($id)
{
    try {
        $sql = "DELETE FROM batches WHERE id = $id";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}






?>