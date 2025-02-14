<?php

class BillController {
    public $billQuery;
    public $billDetailQuery;

    public function __construct() {
        $this -> billQuery = new BillQuery();
        $this -> billDetailQuery = new BillDetailQuery();
    }

    public function __destruct() {

    }

    // -------------Bill-------------

    public function list() {
        $dsBill = $this->billQuery->all();
        include "view/bill/list.php";
    }

    // -------------Bill Detail----------------
    public function listBillDetail() {
        // Lấy thông tin chi tiết đơn hàng
        if (isset($_GET["bill_id"]) && ($_GET["bill_id"]) > 0) {
            $dsBillDetail = $this->billDetailQuery->all($_GET["bill_id"]);
            $info = $this->billQuery->readOneBill($_GET["bill_id"]);
        }
    
        // Xử lý cập nhật trạng thái đơn hàng khi form được gửi
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitFormUpdateBillStatus'])) {
            // Lấy các giá trị từ form
            $bill_id = $_POST['bill_id'];  // Lấy bill_id từ form
            $bill_status = $_POST['bill_status'];  // Lấy bill_status từ form
            $payment_status = $_POST['payment_status'];  // Lấy payment_status từ form (1 hoặc 0)
    
            // Tạo đối tượng Bill và gán giá trị từ form
            $bill = new Bill();
            $bill->bill_id = $bill_id;
            $bill->bill_status = $bill_status;
            $bill->payment_status = $payment_status; // Gán payment_status vào đối tượng Bill
    
            // Cập nhật trạng thái đơn hàng
            $result = $this->billQuery->updateBillStatus($bill);
    
            // Kiểm tra kết quả
            if ($result == "ok") {
                header("Location: ?act=list-bill"); // Redirect sau khi thành công
                exit; // Đảm bảo không có mã nào chạy sau khi redirect
            } else {
                echo "Cập nhật trạng thái đơn hàng thất bại";
            }
        }
    
        include "view/bill/detail.php"; // Gọi lại view để hiển thị
    }
    
}    
?>