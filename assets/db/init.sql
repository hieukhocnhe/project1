CREATE DATABASE inventory_management;

USE inventory_management;

-- Bảng phân quyền (chức vụ)
CREATE TABLE positions (
    id INT(11) NOT NULL PRIMARY KEY,
    position_name VARCHAR(255) NOT NULL
);

INSERT INTO positions (id, position_name) VALUES 
(0, 'Quản lý'), 
(1, 'Nhân viên');



-- Bảng nhà cung cấp
CREATE TABLE suppliers (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    logo VARCHAR(255) NULL,
    contact_person VARCHAR(255) NULL,
    contact_number VARCHAR(15) NULL
);

-- Thiết lập biến cho số lượng bản ghi cần tạo
SET @num_records := 10;

-- Tạo dữ liệu giả mạo cho bảng Suppliers
INSERT INTO suppliers (name, logo, contact_person, contact_number)
SELECT
    CONCAT('Nhà cung cấp ', number) AS name,
    CONCAT('logo', number, '.png') AS logo,
    CONCAT('Người liên hệ ', number) AS contact_person,
    CONCAT('123456789', FLOOR(RAND() * 900) + 100) AS contact_number
FROM (
    SELECT @num_records := @num_records - 1 AS number
    FROM information_schema.tables
) t;

-- Xem các bản ghi được tạo
SELECT * FROM suppliers;


-- Bảng trạng thái lô hàng
CREATE TABLE batch_statuses (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO batch_statuses (name) VALUES
    ('Còn hàng'),
    ('Hết hàng'),
    ('Đang vận chuyển'),
    ('Hỏng'),
    ('Hết hạn'),
    ('Đã trả'),
    ('Được đặt trước'),
    ('Chờ kiểm tra'),
    ('Còn tồn'),
    ('Tạm dừng');

-- Bảng khu vực lưu trữ trong kho
CREATE TABLE storage_areas (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    area_name VARCHAR(255) NOT NULL
);

-- Thiết lập biến cho số lượng bản ghi cần tạo
SET @num_records := 5;

-- Tạo dữ liệu giả mạo cho bảng Storage Areas
INSERT INTO storage_areas (area_name)
SELECT
    CONCAT('Khu vực ', number) AS area_name
FROM (
    SELECT @num_records := @num_records - 1 AS number
    FROM information_schema.tables
) t;

-- Xem các bản ghi được tạo
SELECT * FROM storage_areas;

-- Thiết lập biến cho số lượng bản ghi cần tạo
SET @num_records := 5;

-- Tạo dữ liệu giả mạo cho bảng Storage Areas
INSERT INTO storage_areas (area_name)
SELECT
    CONCAT('Khu vực ', number) AS area_name
FROM (
    SELECT @num_records := @num_records - 1 AS number
    FROM information_schema.tables
) t;

-- Xem các bản ghi được tạo
SELECT * FROM storage_areas;


-- Bảng sản phẩm
CREATE TABLE products (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT(11) NOT NULL,
    image VARCHAR(255) NULL,
    quantity_in_stock INT(11),
    quantity_in_batch INT(11) NOT NULL DEFAULT 0
    batch_id INT(11),  -- Thêm trường batch_id vào bảng products
    FOREIGN KEY (batch_id) REFERENCES batches(id)  -- Khóa ngoại tham chiếu đến bảng batches
);


-- Faker data cho bảng products với trường batched_id random từ 
INSERT INTO products (
    name,
    price,
    image,
    quantity_in_stock,
    quantity_in_batch
)
SELECT
    CONCAT('Product ', FLOOR(RAND() * 1000)),
    -- Tên sản phẩm giả mạo
    FLOOR(RAND() * 100),
    -- Giá giả mạo
    CONCAT('image_', FLOOR(RAND() * 10), '.jpg'),
    -- Đường dẫn ảnh giả mạo
    FLOOR(RAND() * 1000),
    -- Số lượng trong kho giả mạo
    FLOOR(RAND() * (200 - 1 + 1) + 1) -- batched_id random từ 
FROM (
    SELECT @n := @n + 1 AS n
    FROM information_schema.tables,
    (SELECT @n := 0) AS X
    LIMIT 200 -- Số lượng sản phẩm bạn muốn tạo
) AS numbers;



-- Bảng lô hàng
CREATE TABLE batches (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    batche_code VARCHAR(255) NOT NULL,
    supplier_id INT(11) NOT NULL,
    storage_area_id INT(11),
    manufacturing_date DATE NOT NULL,
    expiry_date DATE NOT NULL,
    quantity INT(11) NOT NULL,
    status_id INT(11) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id),
    FOREIGN KEY (status_id) REFERENCES batch_statuses(id)
);


-- Chèn dữ liệu giả mạo vào bảng batches
INSERT INTO batches (batche_code, supplier_id, storage_area_id, manufacturing_date, expiry_date, status_id)
SELECT
    CONCAT('Batch Code ', n),
    FLOOR(RAND() * 180) + 1, -- supplier_id (ngẫu nhiên từ 1 đến 208)
    FLOOR(RAND() * 180) + 1, -- storage_area_id (ngẫu nhiên từ 1 đến 208)
    '2023-01-01',
    '2023-12-31',
    FLOOR(RAND() * 10) + 1 -- status_id (ngẫu nhiên từ 1 đến 10)
FROM (
    SELECT @n := @n + 1 AS n
    FROM information_schema.tables, (SELECT @n := 0) AS x
    LIMIT 100 -- Số lượng batches bạn muốn tạo
) AS numbers;


-- Bảng chi tiết lô hàng - sản phẩm
CREATE TABLE batch_products (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    batch_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    -- Các cột khác liên quan đến sản phẩm trong lô hàng (nếu có)
    FOREIGN KEY (batch_id) REFERENCES batches(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);


-- Chèn dữ liệu giả mạo vào bảng batch_products với trường product_id ngẫu nhiên từ 5 đến 200
INSERT INTO batch_products (batch_id, product_id, quantity)
SELECT
    b.id AS batch_id,
    FLOOR(RAND() * (195) + 5) AS product_id, -- Số ngẫu nhiên từ 5 đến 200
    FLOOR(RAND() * 100) + 1 -- Số lượng (ngẫu nhiên từ 1 đến 100)
FROM
    batches b
LIMIT 200; -- Số lượng bản ghi bạn muốn tạo


-- Bảng tài khoản
-- status : đang làm việc/đã nghỉ việc
CREATE TABLE accounts (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NULL,
    tel VARCHAR(15) NULL,
    bio TEXT NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'Đang làm việc', 
    position_id INT(11) NOT NULL DEFAULT 1,
    notification_enabled BOOLEAN DEFAULT 1,
    products_to_ship TEXT,
    FOREIGN KEY (position_id) REFERENCES positions(id) ON DELETE CASCADE
);

-- Thiết lập biến cho số lượng bản ghi cần tạo
SET @num_records := 10;

-- Tạo dữ liệu giả mạo cho bảng Accounts
INSERT INTO accounts (username, password, fullname, email, address, tel, bio, status, position_id, notification_enabled, products_to_ship)
SELECT
    CONCAT('user', number) AS username,
    MD5(CONCAT('password', number)) AS password,
    CONCAT('Họ tên ', number) AS fullname,
    CONCAT('user', number, '@example.com') AS email,
    CONCAT('Địa chỉ ', number) AS address,
    CONCAT('123456789', FLOOR(RAND() * 900) + 100) AS tel,
    CONCAT('Bio ', number) AS bio,
    IF(RAND() > 0.5, 'Đã nghỉ việc', 'Đang làm việc') AS status,
    FLOOR(RAND() * 2) AS position_id,
    RAND() > 0.5 AS notification_enabled,
    CONCAT('Sản phẩm ', number) AS products_to_ship
FROM (
    SELECT @num_records := @num_records - 1 AS number
    FROM information_schema.tables
) t;

-- Xem các bản ghi được tạo
SELECT * FROM accounts;


-- Bảng giao dịch
CREATE TABLE transactions (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11),
    transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    transaction_type TINYINT(1) NOT NULL,
    quantity_changed INT(11) NOT NULL,
    storage_area_id INT(11) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id)
);

-- Bảng hóa đơn
CREATE TABLE invoices (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT(11) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total_amount INT(11),
    status VARCHAR(50) NOT NULL,
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
    storage_area_id INT(11),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id)
);

-- Bảng thông báo
CREATE TABLE notifications (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    account_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES accounts(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
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
    batche_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    return_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50),
    note TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (batche_id) REFERENCES batches(id)
);
