<?php
function getSupplierById($id)
{
    try {
        $sql = "SELECT * FROM suppliers 
                WHERE id = $id;";
        return pdo_query_one($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getAllSuppliers()
{
    try {
        $sql = "SELECT * FROM suppliers;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function insertSupplier($name, $logo, $contact_person, $contact_number)
{
    try {
        $sql = "INSERT INTO suppliers ( name, logo, contact_person, contact_number ) 
                VALUES ( '$name', '$logo', '$contact_person', '$contact_number' );";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function editSupplier($id, $name, $logo, $contact_person, $contact_number)
{
    try {
        $sql = "UPDATE suppliers SET
                name = '$name',
                logo = '$logo',
                contact_person = '$contact_person',
                contact_number = '$contact_number'
                WHERE id = $id;";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function deleteSupplier($id)
{
    try {
        $sql = "DELETE FROM suppliers 
                WHERE id = $id;";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

?>