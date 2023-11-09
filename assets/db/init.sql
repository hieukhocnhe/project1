CREATE DATABASE inventory_management;

USE inventory_management;

-- Bảng phân quyền (chức vụ)
CREATE TABLE positions (
    id INT(11) NOT NULL PRIMARY KEY,
    position_name VARCHAR(255) NOT NULL
);

-- Bảng tài khoản
CREATE TABLE accounts (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NULL,
    tel VARCHAR(15) NULL,
    introduce TEXT NULL,
    status TINYINT(1) NOT NULL,
    position_id INT(11) NOT NULL DEFAULT 1,
    notification_enabled BOOLEAN DEFAULT 1,
    notification_message TEXT,
    products_to_ship TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (position_id) REFERENCES positions(id) ON DELETE CASCADE
);

-- Bảng nhà cung cấp
CREATE TABLE suppliers (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255),
    contact_number VARCHAR(15)
);

-- Bảng sản phẩm
CREATE TABLE products (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT(11) NOT NULL,
    quantity_in_stock INT(11),
    supplier_id INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

-- Bảng giao dịch
CREATE TABLE transactions (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11),
    transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    transaction_type VARCHAR(50),
    quantity_changed INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Bảng khu vực lưu trữ trong kho
CREATE TABLE storage_areas (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    area_name VARCHAR(255) NOT NULL
);

-- Bảng giao dịch nhập kho
CREATE TABLE incoming_transactions (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11),
    transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    quantity INT(11),
    storage_area_id INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id)
);

-- Bảng giao dịch xuất kho
CREATE TABLE outgoing_transactions (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11),
    transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    quantity INT(11),
    storage_area_id INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id)
);

-- Bảng hóa đơn
CREATE TABLE invoices (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total_amount INT(11),
    status VARCHAR(50),
    storage_area_id INT(11),
    FOREIGN KEY (transaction_id) REFERENCES transactions(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id)
);

-- Bảng chi tiết hóa đơn
CREATE TABLE invoice_details (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT(11),
    product_id INT(11),
    quantity INT(11),
    unit_price INT(11),
    total_amount INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (invoice_id) REFERENCES invoices(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Bảng sản phẩm cần xuất cho từng tài khoản
CREATE TABLE products_to_ship (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    account_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES accounts(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Bảng thống kê và báo cáo
CREATE TABLE stock_statistics (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11) NOT NULL,
    stock_date DATE NOT NULL,
    starting_quantity INT(11),
    ending_quantity INT(11),
    transactions_count INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Bảng thông báo
CREATE TABLE notifications (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    account_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);

-- Bảng tồn kho
CREATE TABLE inventory (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11),
    stockdate DATETIME NOT NULL,
    quantity INT(11) NULL,
    transaction_type VARCHAR(50),
    transaction_id INT(11),
    storage_area_id INT(11),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (transaction_id) REFERENCES transactions(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id)
);

-- Bảng đổi trả
CREATE TABLE returns (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    return_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50),
    note TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
