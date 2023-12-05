<?php 

include './lib/PhpExcel/vendor/autoload.php';

// Hàm ghi dữ liệu vào file Excel
function writeStudentsToExcel($products, $filename)
{
    try {
        $objPHPExcel = new PHPExcel();

        // tạo một sheet mới
        $objPHPExcel->setActiveSheetIndex(0);
        $worksheet = $objPHPExcel->getActiveSheet();

        // khai báo tiêu đề cho các cột
        $headers = array('ID', 'Name','Price','Quantity_In_Stock','Quantity_In_Batch', 'Manufaturing_Date','Expiry_Date', 'Unit');
        $col = 0;
        foreach ($headers as $header) {
            $worksheet->setCellValueByColumnAndRow($col, 1, $header);
            $col++;
        }

        // thêm dữ liệu cho các dòng tiếp theo
        $row = 2;
        foreach ($products as $product) {
            $col = 0;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['id']);
            $col++;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['name']);
            $col++;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['price']);
            $col++;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['quantity_in_stock']);
            $col++;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['quantity_in_batch']);
            $col++;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['manufacturing_date']);
            $col++;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['expiry_date']);
            $col++;
            $worksheet->setCellValueByColumnAndRow($col, $row, $product['unit']);
            $col++;
        }

        // đặt tên file và lưu file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save($filename);
        echo 'Xuất file thành công' . "\n";
    } catch (Exception $e) {
        echo 'Xuất file thất bại. Lỗi: ', $e->getMessage(), "\n";
    }
}

// Hàm lấy ra số lượng sheet trong file Excel
function getSheetCount($filename)
{
    $objPHPExcel = PHPExcel_IOFactory::load($filename);
    $sheetCount = $objPHPExcel->getSheetCount();
    return $sheetCount;
}

// Hàm đọc dữ liệu từ file Excel dựa theo tên sheet
function readDataFromExcelBySheetName($filename, $sheetName)
{
    try {
        $objPHPExcel = PHPExcel_IOFactory::load($filename);
        $worksheet = $objPHPExcel->getSheetByName($sheetName);

        if (!$worksheet) {
            return false; // Trang không tồn tại
        }

        $data = $worksheet->toArray(null, true, true, true);
        return $data;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function getFirstSheetName($filename)
{
    $objPHPExcel = PHPExcel_IOFactory::load($filename);
    $sheetNames = $objPHPExcel->getSheetNames();
    return $sheetNames[0];
}
?>