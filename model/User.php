<?php
// model/User.php

require_once 'core/BaseModel.php';

class User extends BaseModel {
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        return $this->fetchAll($sql);
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->fetch($sql, [$id]);
    }

    public function createUser($data) {
        $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
        return $this->execute($sql, [$data['name'], $data['email']]);
    }

    public function updateUser($id, $data) {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        return $this->execute($sql, [$data['name'], $data['email'], $id]);
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        return $this->execute($sql, [$id]);
    }

    public function getOrder($order_id) {
        $sql = "
       SELECT 
    o.order_id, 
    o.user_id, 
    u.full_name AS customer_name, 
    u.email AS customer_email, 
    u.phone_number AS customer_phone, 
    o.total_amount AS order_total, 
    o.status AS order_status, 
    o.payment_status AS payment_status, 
    o.payment_method AS payment_method, 
    o.created_at AS order_date, 
    oi.order_item_id, 
    oi.product_name, 
    oi.variant_name, 
    oi.quantity, 
    oi.price, 
    oi.total_price, 
    oi.product_image
FROM Orders o
JOIN Users u ON o.user_id = u.user_id
JOIN Order_Items oi ON o.order_id = oi.order_id
WHERE o.order_id = 1";


        return $this->fetchAll($sql, [$order_id]); // Truyền $order_id vào như tham số
    }
}
