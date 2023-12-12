<?php

function getAllStorageArea() {
    try {
        $sql = "SELECT * FROM storage_areas";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


function insertStorageArea ($area_name) {
    try {
        $sql = "INSERT INTO storage_areas (area_name) VALUES ('$area_name')";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


function editStorageArea($id, $area_name) {
    try {
        $sql = "UPDATE storage_areas
                SET
                area_name = '$area_name'
                WHERE id = $id;";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


function deleteStorageArea($id) {
    try {
        $sql = "DELETE FROM storage_areas 
                WHERE id = $id";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getStorageAreaById($id) {
    try {
        $sql = "SELECT
                    sa.id AS storage_area_id, sa.area_name, 
                    b.id AS batch_id, b.batche_code,
                    p.id AS product_id, p.name AS product_name,
                    bp.id AS batch_product_id
                FROM
                    storage_areas sa
                    LEFT JOIN batches b ON sa.id = b.storage_area_id
                    LEFT JOIN batch_products bp ON b.id = bp.batch_id
                    LEFT JOIN products p ON bp.product_id = p.id
                WHERE
                    sa.id = $id;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


?>