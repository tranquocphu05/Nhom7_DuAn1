<?php
// index.php

require_once 'config.php';
require_once 'core/BaseController.php';
require_once 'core/BaseModel.php';

// Xử lý phân loại người dùng và yêu cầu
session_start();

$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 'client'; // Giả sử có role trong session

if ($userRole === 'admin') {
    $controller = 'AdminController';
    $folder = 'admin';
} else {
    $controller = 'ClientController';
    $folder = 'client';
}

$controllerPath = "controller/{$folder}/{$controller}.php";

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controllerInstance = new $controller();
    $controllerInstance->index(); // Giả sử mỗi controller đều có phương thức index
} else {
    die("Controller không tồn tại");
}
