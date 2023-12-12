<?php

include_once 'product.php';
include_once 'batche.php';
function getAllTransactionByProductId($id)
{
    try {
        $sql = "SELECT t.*, 
                    p.id AS product_id, p.name AS product_name, p.quantity_in_stock AS quantity_in_stock,p.price AS product_price,
                    tt.name AS transaction_type_name,
                    a.fullname AS fullname,
                    s.area_name AS area_name,
                    ts.name AS status_name
                FROM products p
                LEFT JOIN transactions t ON p.id = t.product_id
                LEFT JOIN transaction_types tt ON t.transaction_type_id = tt.id
                LEFT JOIN accounts a ON t.account_id = a.id
                LEFT JOIN storage_areas s ON t.storage_area_id = s.id
                LEFT JOIN transaction_statuses ts ON t.status_id = ts.id
                WHERE p.id = '$id'
                ORDER BY t.transaction_date DESC;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getTransactionDetail($id)
{
    try {
        $sql = "SELECT t.*, 
                    p.name AS product_name, p.quantity_in_stock AS quantity_in_stock,
                    p.unit AS product_unit, p.price AS product_price,
                    tt.name AS transaction_type_name,
                    a.fullname AS fullname,
                    s.area_name AS area_name,
                    ts.name AS status_name
                FROM transactions t
                LEFT JOIN products p ON t.product_id = p.id
                LEFT JOIN transaction_types tt ON t.transaction_type_id = tt.id
                LEFT JOIN accounts a ON t.account_id = a.id
                LEFT JOIN storage_areas s ON t.storage_area_id = s.id
                LEFT JOIN transaction_statuses ts ON t.status_id = ts.id
                WHERE t.id = '$id';";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getAllTypeTransaction()
{
    try {
        $sql = "SELECT * FROM transaction_types;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


function numberToWordsVND($number)
{
    $ones = array(
        0 => 'Không',
        1 => 'Một',
        2 => 'Hai',
        3 => 'Ba',
        4 => 'Bốn',
        5 => 'Năm',
        6 => 'Sáu',
        7 => 'Bảy',
        8 => 'Tám',
        9 => 'Chín'
    );

    $teens = array(
        11 => 'Mười Một',
        12 => 'Mười Hai',
        13 => 'Mười Ba',
        14 => 'Mười Bốn',
        15 => 'Mười Lăm',
        16 => 'Mười Sáu',
        17 => 'Mười Bảy',
        18 => 'Mười Tám',
        19 => 'Mười Chín'
    );

    $tens = array(
        1 => 'Mười',
        2 => 'Hai Mươi',
        3 => 'Ba Mươi',
        4 => 'Bốn Mươi',
        5 => 'Năm Mươi',
        6 => 'Sáu Mươi',
        7 => 'Bảy Mươi',
        8 => 'Tám Mươi',
        9 => 'Chín Mươi'
    );

    $quarters = array(
        'Nghìn',
        'Triệu',
        'Tỷ',
        'Nghìn Tỷ',
        'Triệu Tỷ',
        'Tỷ Tỷ'
    );

    // Convert to words
    $num = number_format($number, 0, '', '');
    $numArr = array_reverse(str_split($num));
    $output = '';

    foreach ($numArr as $key => $num) {
        if (($key % 3 == 0) && ($key > 0)) {
            $output = $quarters[$key / 3 - 1] . ' ' . $output;
        }

        $digit = (int) $num;

        switch ($key % 3) {
            case 0:
                $output = $ones[$digit] . ' ' . $output;
                break;
            case 1:
                if ($digit == 1) {
                    $output = $teens[$digit * 10 + (int) $numArr[$key - 1]] . ' ' . $output;
                    // Skip the next digit
                    $key++;
                } else {
                    $output = $tens[$digit] . ' ' . $output;
                }
                break;
            case 2:
                if ($digit != 0) {
                    $output = $ones[$digit] . ' Trăm ' . $output;
                }
                break;
        }
    }

    $output .= 'Việt Nam Đồng';

    return $output;
}

function getAllTransactionStatus()
{
    try {
        $sql = "SELECT * FROM transaction_statuses;";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


function processIncomingTransaction($product_id, $transaction_date, $transaction_type_id, $quantity_changed, $storage_area_id, $account_id, $transaction_code, $status_id, $quantityInStock, $total_amount)
{

    try {
        $transaction_code = generateRandomString();
        $sql = "INSERT INTO transactions(product_id, transaction_date, transaction_type_id, quantity_changed, storage_area_id, 
                                        account_id, transaction_code, status_id, previous_quantity, total_amount)
                VALUES ('$product_id', '$transaction_date', '$transaction_type_id', '$quantity_changed', $storage_area_id, '$account_id',
                        '$transaction_code', '$status_id', '$quantityInStock', '$total_amount');

                UPDATE products
                SET quantity_in_stock = 
                IF((SELECT status_id FROM transactions WHERE id = LAST_INSERT_ID()) = 1, quantity_in_stock + $quantity_changed, quantity_in_stock)
                WHERE id = $product_id;

                INSERT INTO inventory (product_id, stockdate, quantity, transaction_type, transaction_id, storage_area_id)
                VALUES (
                    '$product_id',
                    '$transaction_date',
                    '$quantity_changed',
                    '$transaction_type_id',
                    LAST_INSERT_ID(),
                    $storage_area_id);";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function processOutcomingTransaction($product_id, $transaction_date, $transaction_type_id, $quantity_changed, $storage_area_id, $account_id, $transaction_code, $status_id, $quantityInStock, $total_amount)
{

    try {
        $transaction_code = generateRandomString();
        $sql = "INSERT INTO transactions(product_id, transaction_date, transaction_type_id, quantity_changed, storage_area_id, 
                                        account_id, transaction_code, status_id, previous_quantity, total_amount)
                VALUES ('$product_id', '$transaction_date', '$transaction_type_id', '$quantity_changed', $storage_area_id, '$account_id',
                        '$transaction_code', '$status_id', '$quantityInStock', '$total_amount');

                UPDATE products
                SET quantity_in_stock = 
                IF((SELECT status_id FROM transactions WHERE id = LAST_INSERT_ID()) = 1, quantity_in_stock - $quantity_changed, quantity_in_stock)
                WHERE id = $product_id;

                INSERT INTO inventory (product_id, stockdate, quantity, transaction_type, transaction_id, storage_area_id)
                VALUES (
                    '$product_id',
                    '$transaction_date',
                    '$quantity_changed',
                    '$transaction_type_id',
                    LAST_INSERT_ID(),
                    $storage_area_id);";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function editTransaction($id, $product_id, $transaction_date, $transaction_type_id, $quantity_changed, $storage_area_id, $account_id, $transaction_code, $status_id, $previous_quantity, $total_amount)
{
    try {
        $sql = "UPDATE transactions
                SET
                    product_id = '$product_id',
                    transaction_date = '$transaction_date',
                    transaction_type_id = '$transaction_type_id',
                    quantity_changed = '$quantity_changed',
                    storage_area_id = $storage_area_id,
                    account_id = '$account_id',
                    transaction_code = '$transaction_code',
                    status_id = CASE
                                    WHEN '$status_id' <> 1 THEN 1
                                    ELSE '$status_id'
                                END,
                    previous_quantity = '$previous_quantity',
                    total_amount = '$total_amount'
                WHERE
                    id = '$id';

                UPDATE products
                SET
                    quantity_in_stock = 
                        CASE
                            WHEN '$transaction_type_id' = 2 THEN quantity_in_stock - '$quantity_changed'
                            ELSE quantity_in_stock + '$quantity_changed'
                        END
                WHERE
                    id = '$product_id'
                    AND '$status_id' = 1;

                
                INSERT INTO inventory (product_id, stockdate, quantity, transaction_type, transaction_id, storage_area_id)
                VALUES (
                    '$product_id',
                    NOW(),
                    '$quantity_changed',
                    '$transaction_type_id',
                    '$id', 
                    $storage_area_id);";
        pdo_execute($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

?>