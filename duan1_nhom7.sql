-- Tạo bảng Users
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('client', 'admin') NOT NULL,
    full_name VARCHAR(255),
    phone_number VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tạo bảng Categories
CREATE TABLE Categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

-- Tạo bảng Products
CREATE TABLE Products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    stock_quantity INT NOT NULL,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

-- Tạo bảng product_variants
CREATE TABLE product_variants (
    VariantID INT AUTO_INCREMENT PRIMARY KEY,
    ProductID INT NOT NULL,
    VariantName VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Weight DECIMAL(10, 2) DEFAULT NULL,
    Size VARCHAR(50) DEFAULT NULL,
    Stock INT NOT NULL,
    ImageURL VARCHAR(255),
    CreatedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ProductID) REFERENCES Products(product_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Tạo bảng Orders
CREATE TABLE Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'confirmed', 'shipped', 'delivered', 'canceled') NOT NULL DEFAULT 'pending',
    payment_status ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending',
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Tạo bảng Order_Items
CREATE TABLE Order_Items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_variant_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    variant_name VARCHAR(255) NOT NULL,
    product_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_variant_id) REFERENCES product_variants(VariantID)
);

-- Tạo bảng Cart
CREATE TABLE Cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

-- Tạo bảng Payments
CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    payment_method VARCHAR(50),
    payment_status ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending',
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);

-- Tạo bảng Addresses
CREATE TABLE Addresses (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    address_line1 VARCHAR(255) NOT NULL,
    address_line2 VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    postal_code VARCHAR(20),
    country VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Chèn dữ liệu vào bảng Categories
INSERT INTO Categories (name, description) VALUES
('Trà sữa', 'Các loại trà sữa cơ bản như trà đen, trà xanh, sữa đặc, v.v.'),
('Topping', 'Các loại topping như trân châu, thạch, khúc bạch, v.v.'),
('Sữa & Đường', 'Sữa đặc, đường, các nguyên liệu làm ngọt trà sữa'),
('Dụng cụ làm trà sữa', 'Máy pha trà, cốc, ly, ống hút trà sữa'),
('Phụ kiện khác', 'Các phụ kiện bổ sung khác cho trà sữa như túi lọc, đồ trang trí, v.v.');

-- Chèn dữ liệu vào bảng Products
INSERT INTO Products (name, description, price, image_url, stock_quantity, category_id) VALUES
('Trà sữa đen', 'Trà sữa đen thơm ngon, 1kg', 100000, 'https://example.com/trasua-den.jpg', 100, 1),
('Trân Châu Đen', 'Trân châu đen, 500g', 35000, 'https://example.com/tra-chau-den.jpg', 200, 2),
('Trân Châu Hoàng Kim', 'Trân châu hoàng kim, 500g', 45000, 'https://example.com/tra-chau-hoang-kim.jpg', 150, 2),
('Sữa đặc', 'Sữa đặc, 1kg', 70000, 'https://example.com/sua-dac.jpg', 80, 3),
('Máy pha trà sữa', 'Máy pha trà sữa tự động, dung tích 3L', 1200000, 'https://example.com/may-pha-tra.jpg', 15, 4),
('Ly nhựa cao cấp', 'Ly nhựa đựng trà sữa, 500ml', 5000, 'https://example.com/ly-nhua.jpg', 300, 5),
('Ống hút trà sữa', 'Ống hút dẻo, dài 20cm, gói 50 cái', 20000, 'https://example.com/ong-hut.jpg', 500, 5);
-- Chèn dữ liệu vào bảng Users
INSERT INTO Users (username, password, email, role, full_name, phone_number) VALUES
('shop_owner', 'adminpassword', 'shop_owner@example.com', 'admin', 'Shop Owner', '0901234567'),
('sara_tea', 'password123', 'sara_tea@example.com', 'client', 'Sara Tea', '0912345678'),
('tom_bubble', 'password456', 'tom_bubble@example.com', 'client', 'Tom Bubble', '0923456789');

-- Chèn dữ liệu vào bảng Orders
INSERT INTO Orders (user_id, total_amount, status, payment_status, payment_method) VALUES
(2, 100000, 'pending', 'pending', 'Credit Card'),
(3, 1200000, 'confirmed', 'paid', 'Bank Transfer');

-- Chèn dữ liệu vào bảng Order_Items
INSERT INTO Order_Items (order_id, product_variant_id, quantity, price, total_price, product_name, variant_name, product_image)
VALUES
(1, 1, 2, 120000, 240000, 'Trà sữa đen', '500ml', 'https://example.com/trasua-den-500ml.jpg'),
(1, 2, 1, 35000, 35000, 'Trân Châu Đen', '500g', 'https://example.com/tra-chau-den.jpg'),
(1, 3, 1, 45000, 45000, 'Trân Châu Hoàng Kim', '500g', 'https://example.com/tra-chau-hoang-kim.jpg'),
(2, 4, 1, 1200000, 1200000, 'Máy pha trà sữa', '3L', 'https://example.com/may-pha-tra-3L.jpg');

-- Chèn dữ liệu vào bảng Cart
INSERT INTO Cart (user_id, product_id, quantity) VALUES
(2, 1, 2),
(2, 2, 1),
(2, 3, 1),
(3, 5, 1);

-- Chèn dữ liệu vào bảng Addresses
INSERT INTO Addresses (user_id, address_line1, city, postal_code, country, phone_number) VALUES
(2, '123 Trà Sữa Street', 'Hanoi', '100000', 'Vietnam', '0912345678'),
(3, '456 Bubble Tea Road', 'Ho Chi Minh City', '700000', 'Vietnam', '0923456789');

-- Chèn dữ liệu vào bảng product_variants
INSERT INTO product_variants (ProductID, VariantName, Price, Weight, Size, Stock, ImageURL)
VALUES
(1, '500ml', 120000, 0.5, 'Medium', 50, 'https://example.com/trasua-den-500ml.jpg'),
(1, '1L', 220000, 1.0, 'Large', 30, 'https://example.com/trasua-den-1L.jpg'),
(5, '3L', 1200000, 3.0, 'Medium', 10, 'https://example.com/may-pha-tra-3L.jpg');
