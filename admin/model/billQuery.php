<?php
// ------------------------Tổng quan đơn hàng---------------------
class BillQuery {
    public $pdo;

    public function __construct() {
        $this->pdo = connectDB();
    }

    public function __destruct() {
        $this -> pdo = null;
    }

    public function all() {
        try {
            $sql = "select * from bill join account on bill.acc_id = account.acc_id ORDER BY bill.bill_id DESC";
            $data = $this->pdo->query($sql)->fetchAll();
            $dsBill = [];

            foreach ($data as $row) {
                $dsBill[] = convertToObjectBill($row);
            }

            return $dsBill;
            
        } catch (Exception $e) {
            echo "Lỗi: ".$e ->getMessage();
            echo "<hr>";
        }

    }

    public function readOneBill($bill_id) {
        try {
            $sql = "select * from bill join account on bill.acc_id = account.acc_id where bill.bill_id = $bill_id";
            $data = $this->pdo->query($sql)->fetch();
            $info = convertToObjectBill($data);
            return $info;
            
        } catch (Exception $e) {
            echo "Lỗi: ".$e ->getMessage();
            echo "<hr>";
        }
    }
    public function updatePaymentStatus($bill_id, $payment_status) {
        try {
            // Cập nhật payment_status của đơn hàng theo bill_id
            $sql = "UPDATE bill 
                    SET payment_status = :payment_status
                    WHERE bill_id = :bill_id";
    
            $stmt = $this->pdo->prepare($sql);
    
            // Gán giá trị cho tham số trong câu lệnh SQL
            $stmt->bindParam(':payment_status', $payment_status, PDO::PARAM_INT);  // Giới thiệu kiểu dữ liệu là INT
            $stmt->bindParam(':bill_id', $bill_id, PDO::PARAM_INT);  // Gán giá trị bill_id
    
            // Thực thi câu lệnh SQL
            $stmt->execute();
    
            // Kiểm tra kết quả của câu lệnh
            if ($stmt->rowCount() > 0) {
                return "Cập nhật trạng thái thanh toán thành công!";
            } else {
                return "Không có thay đổi nào được thực hiện.";
            }
    
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            echo "<hr>";
        }
    }
    
    
    
    
    public function updateBillStatus(Bill $bill) {
        try {
            $sql = "UPDATE `bill` SET `bill_status`='$bill->bill_status' WHERE `bill_id`='$bill->bill_id' ";
            $data = $this->pdo->exec($sql);
            if ($data == 1 || $data == 0) {
                return "ok";
            } else {
                return $data;
            }

        } catch (Exception $e) {
            echo "Lỗi: ".$e ->getMessage();
            echo "<hr>";
        }
    }
}


// ---------------------Chi tiết đơn hàng--------------------
class BillDetailQuery {
    public $pdo;

    public function __construct() {
        $this->pdo = connectDB();
    }

    public function __destruct() {
        $this -> pdo = null;
    }

    public function all($bill_id) {
        try {
            $sql = "select * from bill_detail join product_detail on bill_detail.pro_dt_id = product_detail.product_dt_id where bill_id = $bill_id";
            $data = $this->pdo->query($sql)->fetchAll();
            $dsBillDetail = [];

            foreach ($data as $row) {
                $dsBillDetail[] = convertToObjectBillDetail($row);
            }

            return $dsBillDetail;
            
        } catch (Exception $e) {
            echo "Lỗi: ".$e ->getMessage();
            echo "<hr>";
        }

    }

}

?>