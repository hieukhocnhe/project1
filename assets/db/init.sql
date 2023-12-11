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

-- Bảng lô hàng
CREATE TABLE batches (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    batche_code VARCHAR(255) NOT NULL,
    supplier_id INT(11) NOT NULL,
    storage_area_id INT(11),
    manufacturing_date DATE NOT NULL,
    expiry_date DATE NOT NULL,
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

CREATE TABLE product_statuses (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

INSERT INTO product_statuses (name) VALUES
    ('Hoạt động'),
    ('Hết hàng'),
    ('Ngừng kinh doanh'),
    ('Sắp ra mắt'),
    ('Khuyến mãi'),
    ('Hàng mới'),
    ('Khả dụng trực tuyến'),
    ('Chờ xử lý'),
    ('Chờ xác nhận'),
    ('Chờ thanh toán');


-- Bảng sản phẩm
CREATE TABLE products (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT(11) NOT NULL,
    image VARCHAR(255) NULL,
    quantity_in_stock INT(11),
    quantity_in_batch INT(11) NOT NULL DEFAULT 0,
    status_id TINYINT(1) NOT NULL DEFAULT 1,
    manufacturing_date DATE,
    expiry_date DATE,
    batch_id INT(11),  -- Thêm trường batch_id vào bảng products
    FOREIGN KEY (batch_id) REFERENCES batches(id),  -- Khóa ngoại tham chiếu đến bảng batches
    FOREIGN KEY (status_id) REFERENCES product_statuses(id)
);


-- Faker data cho bảng products với trường batch_id random từ 1 đến 100
INSERT INTO products (
    name,
    price,
    image,
    quantity_in_stock,
    quantity_in_batch,
    manufacturing_date,
    expiry_date,
    batch_id
)
SELECT
    CONCAT('Product ', FLOOR(RAND() * 1000)),
    FLOOR(RAND() * 100),
    CONCAT('image_', FLOOR(RAND() * 10), '.jpg'),
    FLOOR(RAND() * 1000),
    FLOOR(RAND() * 1000),
    CURDATE() - INTERVAL FLOOR(RAND() * 365) DAY,  -- Ngày sản xuất giả mạo (trong vòng 1 năm trước)
    CURDATE() + INTERVAL FLOOR(RAND() * 365) DAY,  -- Ngày hết hạn giả mạo (trong vòng 1 năm sau)
    FLOOR(RAND() * 100) + 1  -- batch_id random từ 1 đến 100
FROM (
    SELECT @n := @n + 1 AS n
    FROM information_schema.tables,
    (SELECT @n := 0) AS X
    LIMIT 200 -- Số lượng sản phẩm bạn muốn tạo
) AS numbers;




-- Bảng chi tiết lô hàng - sản phẩm
CREATE TABLE batch_products (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    batch_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    -- Các cột khác liên quan đến sản phẩm trong lô hàng (nếu có)
    FOREIGN KEY (batch_id) REFERENCES batches(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Chèn dữ liệu giả mạo vào bảng batch_products với trường product_id ngẫu nhiên từ 5 đến 200
INSERT INTO batch_products (batch_id, product_id)
SELECT
    b.id AS batch_id,
    FLOOR(RAND() * (195) + 5) AS product_id, -- Số ngẫu nhiên từ 5 đến 200
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
    avatar VARCHAR(255) NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NULL,
    tel VARCHAR(15) NULL,
    bio TEXT NULL,
    status VARCHAR(255) NOT NULL DEFAULT 'Đang làm việc', 
    position_id INT(11) NOT NULL DEFAULT 1,
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
    FLOOR(RAND() * 2) AS position_id
FROM (
    SELECT @num_records := @num_records - 1 AS number
    FROM information_schema.tables
) t;

-- Xem các bản ghi được tạo
SELECT * FROM accounts;

-- Bảng loại giao dịch
CREATE TABLE transaction_types (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL
);

-- Insert dữ liệu giả cho bảng transaction_type
INSERT INTO transaction_types (name, description, created_at, updated_at) VALUES
    ('Nhập kho', 'Giao dịch nhập sản phẩm vào kho', NOW(), NOW()),
    ('Xuất kho', 'Giao dịch xuất sản phẩm từ kho', NOW(), NOW()),
    ('Đổi trả', 'Giao dịch đổi trả sản phẩm', NOW(), NOW()),
    ('Kiểm kê', 'Giao dịch kiểm kê tồn kho', NOW(), NOW());

-- Bảng giao dịch
CREATE TABLE transactions (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_id INT(11) NOT NULL,
    transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    transaction_type_id INT(11) NOT NULL,
    quantity_changed INT(11) NOT NULL,
    storage_area_id INT(11) NOT NULL,
    account_id INT(11) NOT NULL,
    transaction_code VARCHAR(255) NOT NULL,
    status VARCHAR(50), 
    previous_quantity INT(11),
    total_amount INT(11) NULL,
    FOREIGN KEY (transaction_type_id) REFERENCES transaction_types(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (storage_area_id) REFERENCES storage_areas(id),
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);


-- Insert dữ liệu giả cho bảng transactions
INSERT INTO transactions (transaction_date, transaction_type_id, quantity_changed, storage_area_id, account_id, transaction_code, status, previous_quantity, total_amount)
SELECT
    NOW() - INTERVAL FLOOR(RAND() * 365) DAY AS transaction_date,
    FLOOR(1 + RAND() * 4) AS transaction_type_id,
    FLOOR(1 + RAND() * 100) AS quantity_changed,
    FLOOR(1 + RAND() * 300) AS storage_area_id,
    FLOOR(1 + RAND() * 4) AS account_id,
    CONCAT('TX', LPAD(FLOOR(100000 + RAND() * 900000), 6, '0')) AS transaction_code,
    CASE
        WHEN RAND() < 0.7 THEN 'Hoàn Thành'
        WHEN RAND() < 0.9 THEN 'Đang Xử Lý'
        ELSE 'Hủy bỏ'
    END AS status,
    FLOOR(1 + RAND() * 50) AS previous_quantity,
    FLOOR(1000 + RAND() * 9000) AS total_amount
FROM
    information_schema.tables;



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

