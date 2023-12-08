<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
}

// Include
include '../model/pdo.php';
include '../model/account.php';
include '../model/supplier.php';
include '../model/storageArea.php';
include '../model/batche.php';
include '../model/product.php';
include '../model/excel.php';
require '../lib/PhpExcel/vendor/autoload.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Hieu's Inventory Management
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <?php include 'layouts/sidebar.php' ?>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <?php include 'layouts/header.php' ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <?php
            if (isset($_GET['act']) && $_GET['act'] !== '') {
                switch ($_GET['act']) {
                    case 'dashboard':
                        include 'dashboard.php';
                        break;
                    case 'accounts';
                        $accounts = getAllAccounts();
                        $positions = getPositions();
                        include '../pages/accounts.php';
                        break;
                    case 'addAccount':
                        if (isset($_POST['addAccount'])) {
                            $username = $_POST['username'];
                            $password = hashPassword($_POST['password']);
                            $fullname = $_POST['fullname'];
                            $email = $_POST['email'];
                            $address = $_POST['address'];
                            $tel = $_POST['tel'];
                            $bio = $_POST['bio'];
                            $position_id = $_POST['position_id'];

                            if ($_FILES['avatar']['name'] != "") {
                                $path = '../assets/img/accounts/';
                                $avatar = $_FILES['avatar']['name'];
                                move_uploaded_file($_FILES['avatar']['tmp_name'], $path . $avatar);
                            }
                        }
                        insertAccount($username, $password, $fullname, $avatar, $email, $address, $tel, $bio, $position_id);
                        echo '<meta http-equiv="refresh" content="0;url=?act=accounts">';
                        break;
                    case 'editAccount':
                        if (isset($_POST['editAccount'])) {
                            $id = $_POST['edit_id'];
                            $username = $_POST['edit_username'];
                            $fullname = $_POST['edit_fullname'];
                            $email = $_POST['edit_email'];
                            $address = $_POST['edit_address'];
                            $tel = $_POST['edit_tel'];
                            $bio = $_POST['edit_bio'];
                            $position_id = $_POST['position_id'];
                            $status = $_POST['edit_status'];
                            $status_text = ($status == 0) ? 'Đã nghỉ việc' : 'Đang làm việc';
                            if ($_FILES['edit_avatar']['name'] != "") {
                                $path = '../assets/img/accounts/';
                                $avatar = $_FILES['edit_avatar']['name'];
                                move_uploaded_file($_FILES['edit_avatar']['tmp_name'], $path . $avatar);
                            } else {
                                $avatar = $_POST['edit_avatar'];
                            }
                        }

                        editAccount($id, $username, $fullname, $avatar, $email, $tel, $address, $bio, $status_text, $position_id);
                        echo '<meta http-equiv="refresh" content="0;url=?act=accounts">';
                        break;
                    case 'delAccount':
                        deleteAccount($_GET['id']);
                        echo '<meta http-equiv="refresh" content="0;url=?act=accounts">';
                        break;
                    case 'suppliers':
                        $suppliers = getAllSuppliers();
                        include '../pages/suppliers.php';
                        break;
                    case 'addSupplier':
                        if (isset($_POST['addSupplier'])) {
                            $name = $_POST['name'];
                            $contact_person = $_POST['contact_person'];
                            $contact_number = $_POST['contact_number'];
                            if ($_FILES['logo']['name'] != "") {
                                $path = '../assets/img/suppliers/';
                                $logo = $_FILES['logo']['name'];
                                move_uploaded_file($_FILES['logo']['tmp_name'], $path . $logo);
                            }
                        }
                        insertSupplier($name, $logo, $contact_person, $contact_number);
                        echo '<meta http-equiv="refresh" content="0;url=?act=suppliers">';
                        break;
                    case 'editSupplier':
                        if (isset($_POST['editSupplier'])) {
                            $id = $_POST['edit_id'];
                            $name = $_POST['edit_name'];
                            $contact_person = $_POST['edit_contact_person'];
                            $contact_number = $_POST['edit_contact_number'];
                            if ($_FILES['edit_logo']['name'] != "") {
                                $path = '../assets/img/suppliers/';
                                $logo = $_FILES['edit_logo']['name'];
                                move_uploaded_file($_FILES['edit_logo']['tmp_name'], $path . $logo);
                            } else {
                                $logo = $_POST['edit_logo'];
                            }
                        }
                        editSupplier($id, $name, $logo, $contact_person, $contact_number);
                        echo '<meta http-equiv="refresh" content="0;url=?act=suppliers">';
                        break;
                    case 'delSupplier':
                        deleteSupplier($_GET['id']);
                        echo '<meta http-equiv="refresh" content="0;url=?act=suppliers">';
                        break;
                    case 'storageAreas':
                        $storageAreas = getAllStorageArea();
                        // var_dump($storageAreas);
                        include '../pages/storageArea/storageAreas.php';
                        break;
                    case 'storageAreasDetail':
                        include '../pages/storageAreas/storageAreasDetail.php';
                        break;
                    case 'addStorageArea':
                        if (isset($_POST['addStorageArea'])) {
                            $area_name = $_POST['area_name'];
                        }
                        insertStorageArea($area_name);
                        echo '<meta http-equiv="refresh" content="0;url=?act=storageAreas">';
                        break;
                    case 'editStorageArea':
                        if (isset($_POST['editStorageArea'])) {
                            $id = $_POST['id'];
                            $area_name = $_POST['area_name'];
                        }
                        editStorageArea($id, $area_name);
                        echo '<meta http-equiv="refresh" content="0;url=?act=storageAreas">';
                        break;
                    case 'batches':
                        $statuses = getAllBatchStatuses();
                        $batches = getAllBatches();
                        include '../pages/batche/batches.php';
                        break;
                    case 'batcheDetail':
                        $batch_detail = getAllProductByBatcheId($_GET['id']);
                        include '../pages/batche/batcheDetail.php';
                        break;
                    case 'addBatche':
                        if (isset($_POST['addBatche'])) {

                            // Thêm một lô hàng
                            $batche_code = $_POST['batche_code'];
                            $supplier_id = $_POST['supplier_id'];
                            $storage_area_id = $_POST['storage_area_id'];
                            $manufacturing_date = $_POST['manufacturing_date'];
                            $expiry_date = $_POST['expiry_date'];
                            $created_at = $_POST['created_at'];
                            $status_id = $_POST['status_id'];

                            $dateTime = new DateTime($created_at);
                            $created_at = $dateTime->format('Y-m-d H:i:s');

                            insertBatche($batche_code, $supplier_id, $storage_area_id, $manufacturing_date, $expiry_date, $created_at, $status_id);
                            // Lấy ra ID lô hàng tạo gần đây nhất
                            $latestBatch = getLatestBatche();
                            $batch_id = $latestBatch['id'];

                            // Xử lý thêm sản phẩm từ file ở đây
                            $file = $_FILES['products'];
                            $file_name = $file['name'];
                            $tmp_file = $file['tmp_name'];
                            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                            $upload_directory = '../assets/public/product_upload/';
                            if ($extension == 'xlsx') {
                                if (move_uploaded_file($tmp_file, $upload_directory . $file_name)) {
                                    echo "Upload file thành công";
                                    $products = readDataFromExcelBySheetName($upload_directory . $file_name, 'products');
                                    foreach ($products as $product) {
                                        if ($product['A'] !== 'name') {
                                            addBatchDetail($batch_id, $product['A']);
                                        }
                                    }
                                } else {
                                    echo "Lỗi trong quá trình upload file";
                                }
                            } else {
                                echo "File không đúng định dạng";
                            }
                        }
                        echo '<meta http-equiv="refresh" content="0;url=?act=batches">';
                        break;
                    case 'editBatche':
                        if (isset($_POST['editBatche'])) {

                            // Thêm một lô hàng
                            $batche_code = $_POST['edit_batche_code'];
                            $supplier_id = $_POST['edit_supplier_id'];
                            $storage_area_id = $_POST['edit_storage_area_id'];
                            $manufacturing_date = $_POST['edit_manufacturing_date'];
                            $expiry_date = $_POST['edit_expiry_date'];
                            $created_at = $_POST['edit_created_at'];
                            $status_id = $_POST['edit_status_id'];

                            $dateTime = new DateTime($created_at);
                            $created_at = $dateTime->format('Y-m-d H:i:s');


                            insertBatche($batche_code, $supplier_id, $storage_area_id, $manufacturing_date, $expiry_date, $created_at, $status_id);

                            // Xử lý thêm sản phẩm từ file ở đây
                            $file = $_FILES['products'];
                            $file_name = $file['name'];
                            $tmp_file = $file['tmp_name'];
                            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                            $upload_directory = '../assets/public/product_upload/';
                            if ($extension == 'xlsx') {
                                if (move_uploaded_file($tmp_file, $upload_directory . $file_name)) {
                                    echo "Upload file thành công";
                                } else {
                                    echo "Lỗi trong quá trình upload file";
                                }
                            } else {
                                echo "File không đúng định dạng";
                            }
                            $products = readDataFromExcelBySheetName($upload_directory . $file_name, 'products');
                            foreach ($products as $product) {
                                if ($product['A'] !== 'name') {
                                    addBatchDetail($batch_id, $product['A']);
                                }
                            }
                        }
                        // echo '<meta http-equiv="refresh" content="0;url=?act=batches">';
                        break;
                    case 'delBatche':
                        deleteBatche($_GET['id']);
                        echo '<meta http-equiv="refresh" content="0;url=?act=batches">';
                        break;
                    case 'products':
                        $products = getAllProducts();
                        include '../pages/products.php';
                        break;
                    case 'addProduct':
                        if (isset($_POST['addProduct'])) {
                            $name = $_POST['name'];
                            $price = $_POST['price'];
                            $quantity_in_stock = $_POST['quantity_in_stock'];
                            $manufacturing_date = $_POST['manufacturing_date'];
                            $expiry_date = $_POST['expiry_date'];
                            $unit = $_POST['unit'];
                            if ($_FILES['image']['name'] != "") {
                                $path = '../assets/img/products/';
                                $image = $_FILES['image']['name'];
                                move_uploaded_file($_FILES['image']['tmp_name'], $path . $image);
                            }
                        }
                        insertProduct($name, $price, $image, $quantity_in_stock, $manufacturing_date, $expiry_date, $unit);
                        echo '<meta http-equiv="refresh" content="0;url=?act=products">';
                        break;
                    case 'editProduct':
                        if (isset($_POST['editProduct'])) {
                            $id = $_POST['edit_id'];
                            $name = $_POST['edit_name'];
                            $price = $_POST['edit_price'];
                            $quantity_in_stock = $_POST['edit_quantity_in_stock'];
                            $quantity_in_batch = $_POST['edit_quantity_in_batch'];
                            $manufacturing_date = $_POST['edit_manufacturing_date'];
                            $expiry_date = $_POST['edit_expiry_date'];
                            $batch_id = $_POST['edit_batch_id'];
                            if ($_FILES['edit_image']['name'] != "") {
                                $path = '../assets/img/products/';
                                $image = $_FILES['edit_image']['name'];
                                move_uploaded_file($_FILES['edit_image']['tmp_name'], $path . $image);
                            } else {
                                $image = $_POST['edit_image'];
                            }
                        }
                        editProduct($name, $price, $image, $quantity_in_stock, $quantity_in_batch, $manufacturing_date, $expiry_date, $batch_id, $id);
                        echo '<meta http-equiv="refresh" content="0;url=?act=products">';
                        break;
                    case 'delProduct':
                        delProduct($_GET['id']);
                        echo '<meta http-equiv="refresh" content="0;url=?act=products">';
                        break;
                    case 'inventories':
                        include '../pages/inventories.php';
                        break;
                    case 'stock_statistics':
                        include '../pages/stock_statistics.php';
                        break;
                    case 'transactions':
                        include '../pages/transactions.php';
                        break;
                    case 'profile':
                        include '../pages/profile.php';
                        break;
                    case 'logout':
                        unset($_SESSION['user']);
                        // var_dump($_SESSION['user']);
                        echo '<meta http-equiv="refresh" content="0;url=index.php">';
                        break;
                    default:
                        include 'dashboard.php';
                        break;
                }
            } else {
                include 'dashboard.php';
            }
            ?>
        </div>
        <div>
            <?php include 'layouts/footer.php' ?>
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js"></script>
    <script src="../assets/js/core/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/argon-dashboard.js"></script>
    <script src="../assets/js/argon-dashboard.js.map"></script>
    <script src="../assets/js/argon-dashboard.min.js"></script>

    <script>
        // Lấy tất cả các liên kết trong menu
        var menuLinks = document.querySelectorAll('.nav-link');

        // Lặp qua từng liên kết và kiểm tra URL hiện tại
        for (var i = 0; i < menuLinks.length; i++) {
            // Lấy href của liên kết
            var href = menuLinks[i].getAttribute('href');
            // Kiểm tra xem URL hiện tại có chứa href của liên kết hay không
            if (window.location.href.indexOf(href) !== -1) {
                // Nếu có, thêm lớp "active" vào liên kết
                menuLinks[i].classList.add('active');
            } else {
                menuLinks[i].classList.remove('active');
            }
        }
    </script>
</body>

</html>