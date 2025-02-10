<?php

require_once './core/BaseController.php';

class AdminController extends BaseController {
    public function index() {
        // Lấy dữ liệu cần thiết
        $model = new User();
        $users = $model->getAllUsers();
        $this->render('admin/dashboard', ['users' => $users]);
    }
    public function orderDetails($order_id) {
        $orderModel = new User();
        $orderDetails = $orderModel->getOrder($order_id);
    var_dump($orderDetails);
    die();
        if ($orderDetails) {
            $this->render('admin/order_details', ['orderDetails' => $orderDetails]);
        } else {
            echo "Không tìm thấy đơn hàng.";
        }
    }
    
    

}
