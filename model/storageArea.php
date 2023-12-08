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







?>