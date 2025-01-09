<?php
// controller/admin/AdminController.php

require_once 'core/BaseController.php';

class AdminController extends BaseController {
    public function index() {
        // Lấy dữ liệu cần thiết
        $model = new User(); // Ví dụ dùng Model User
        $users = $model->getAllUsers();

        // Render view
        $this->render('admin/dashboard', ['users' => $users]);
    }

    // Các hành động khác của admin như thêm, sửa, xóa user...
}
