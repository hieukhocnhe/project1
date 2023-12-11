<?php
include '../model/pdo.php';
include '../model/account.php';

pdo_connect();

// Mảng phân quyền cho Quản lý
$permissionsForManager = array(
    'dashboard' => true,
    'accounts' => true,
    'addAccount' => true,
    'editAccount' => true,
    'suppliers' => true,
    'editSupplier' => true,
    'delSupplier' => true,
    'storageAreas' => true,
    'addStorageArea' => true,
    'editStorageArea' => true,
    'delStorageArea' => true,
    'batches' => true,
    'batcheDetail' => true,
    'addBatche' => true,
    'editBatche' => true,
    'products' => true,
    'productDetail' => true,
    'addProduct' => true,
    'editProduct' => true,
    'transactions' => true,
    'inventories' => true,
    'stock_statistics' => true,
    'profile' => true,
    'change_password_submit' => true,
    'forgot_password' => true
    // Thêm các quyền khác tương ứng với vai trò Quản lý
);
// Mảng phân quyền cho Nhân viên
$permissionsForEmployee = array(
    'dashboard' => true,
    'accounts' => true,
    'addAccount' => false,
    'editAccount' => false,
    'suppliers' => true,
    'editSupplier' => false,
    'delSupplier' => false,
    'storageAreas' => true,
    'storageAreaDetail' => true,
    'addStorageArea' => false,
    'editStorageArea' => false,
    'delStorageArea' => false,
    'batches' => true,
    'batcheDetail' => true,
    'addBatche' => true,
    'editBatche' => true,
    'products' => true,
    'productDetail' => true,
    'addProduct' => true,
    'editProduct' => true,
    'transactions' => true,
    'inventories' => true,
    'stock_statistics' => true,
    'profile' => true,
    'change_password_submit' => true,
    'forgot_password' => true
    // Thêm các quyền khác tương ứng với vai trò Nhân viên
);

// Sử dụng switch case để xác định vai trò của người dùng
$userRole = getPositions(); // Hàm này để lấy vai trò của người dùng

// Giả sử $userRole chứa vai trò cụ thể bạn muốn kiểm tra
$userRole = "Quản lý"; // hoặc "Nhân viên"

// Khởi tạo mảng để lưu trữ danh sách các position_id
$roleIds = array();

// Lặp qua mảng để lấy ra các giá trị position_id
foreach ($userRoles as $role) {
    if ($role['position_name'] === $userRole) {
        $roleIds[] = $role['id'];
    }
}

// Dùng switch case để xác định vai trò của người dùng
switch ($userRole) {
    case 'Quản lý':
        // Kiểm tra xem position_id có tồn tại trong danh sách position_id của Quản lý không
        if (in_array(0, $roleIds)) {
            $permissions = $permissionsForManager;
        } else {
            $permissions = array();
        }
        break;
    case 'Nhân viên':
        // Kiểm tra xem position_id có tồn tại trong danh sách position_id của Nhân viên không
        if (in_array(1, $roleIds)) {
            $permissions = $permissionsForEmployee;
        } else {
            $permissions = array();
        }
        break;
    // Thêm các case khác nếu có nhiều vai trò
    default:
        $permissions = array(); // Mặc định là mảng rỗng nếu không xác định được vai trò
}


// Kiểm tra quyền trước khi thực hiện hành động
// if ($permissions['manage_users']) {
//     // Thực hiện hành động quản lý người dùng
// }

// if ($permissions['manage_products']) {
//     // Thực hiện hành động quản lý sản phẩm
// }

// Thêm các điều kiện kiểm tra quyền khác tùy vào yêu cầu cụ thể của dự án

?>