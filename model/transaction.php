<?php

function getAllTransactionByProductId($id)
{
    try {
        $sql = "SELECT t.*, 
                    p.name AS product_name, p.quantity_in_stock AS quantity_in_stock,
                    tt.name AS transaction_type_name,
                    a.fullname AS fullname,
                    s.area_name AS area_name
                FROM transactions t
                JOIN products p ON t.product_id = p.id
                JOIN transaction_types tt ON t.transaction_type_id = tt.id
                JOIN accounts a ON t.account_id = a.id
                JOIN storage_areas s ON t.storage_area_id = s.id
                WHERE t.product_id = '$id'
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
                    s.area_name AS area_name
                FROM transactions t
                JOIN products p ON t.product_id = p.id
                JOIN transaction_types tt ON t.transaction_type_id = tt.id
                JOIN accounts a ON t.account_id = a.id
                JOIN storage_areas s ON t.storage_area_id = s.id
                WHERE t.id = '$id';";
        return pdo_query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

function getAllTypeTransaction() {
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

        $digit = (int)$num;

        switch ($key % 3) {
            case 0:
                $output = $ones[$digit] . ' ' . $output;
                break;
            case 1:
                if ($digit == 1) {
                    $output = $teens[$digit * 10 + (int)$numArr[$key - 1]] . ' ' . $output;
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

    $output .= 'Đồng';

    return $output;
}

?>


