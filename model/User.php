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
}
