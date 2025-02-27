<?php

class HomeController
{
    public $categoryQuery;
    public $productQuery;
    public $productDetailQuery;
    public $accountQuery;
    public $billQuery;
    public $billDetailQuery;



    public $gioithieu;
    public function __construct()
    {
        $this->productQuery = new ProductQuery();
        $this->productDetailQuery = new ProductDetailQuery();
        $this->categoryQuery = new CategoryQuery();
        $this->accountQuery = new AccountQuery();
        $this->billQuery = new BillQuery();
        $this->billDetailQuery = new BillDetailQuery();

    }

    public function __destruct()
    {

    }

    public function home()
    {
        $dsProduct = $this->productQuery->getTop16ProductLatest();
        $Arr_price = [];
        $mang_pro_id = [];
        $allSlPro = 0;
        foreach ($dsProduct as $row) {
            $arr_min_price = [];
            $dsProDetail = $this->productDetailQuery->listProductDetail($row->pro_id);

            // Kiểm tra nếu có sản phẩm chi tiết
            if ($dsProDetail) {
                foreach ($dsProDetail as $rowDetail) {
                    $price = $rowDetail->pro_price;
                    array_push($arr_min_price, $price);
                }

                // Chỉ gọi min nếu mảng không rỗng
                if (!empty($arr_min_price)) {
                    $price_min = min($arr_min_price);
                    array_push($Arr_price, $price_min);
                } else {
                    // Xử lý trường hợp mảng rỗng (ví dụ: gán giá trị mặc định)
                    array_push($Arr_price, 0); // hoặc bất kỳ giá trị mặc định nào bạn muốn
                }
            } else {
                // Nếu không có sản phẩm chi tiết, có thể xử lý thêm
                array_push($Arr_price, 0); // Hoặc giá trị mặc định khác
            }
        }
        // Tiếp tục các phần mã khác
        $dsCategory = $this->categoryQuery->all();

        include "view/home.php";
    }

    public function ctsp()
    {
        $dsCategory = $this->categoryQuery->all();
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }

        if (isset($_GET['id'])) {
            $pro_id = $_GET['id'];
            $pro_one = $this->productQuery->find($pro_id);
            $cate_id = $pro_one->cate_id;
            $dsProDetail = $this->productDetailQuery->listProductDetail($pro_id);
            $dsProduct_same = $this->productQuery->getProductSameCate_id($cate_id);
            $price = 1000000;
            foreach ($dsProDetail as $row) {

                if ($row->pro_price < $price) {
                    $price = $row->pro_price;
                }
            }
            $price_max = 0;

            foreach ($dsProDetail as $row) {

                if ($row->pro_price > $price_max) {
                    $price_max = $row->pro_price;
                }
            }
        }
        include "view/ctsp.php";
    }
    public function cart()
    {
        if (isset($_POST['addToCart'])) {
            $pro_size = $_POST['pro_size'];
            $pro_color = $_POST['pro_color'];
            $pro_id = $_POST['pro_id'];
            $soluong = $_POST['soluong'];
            // Kiểm tra tính hợp lệ của thông tin
            if (!$pro_color && !$pro_size) {
                ?>
                <script>
                    alert("Vui lòng chọn màu sắc và kích cỡ");
                    window.location.href = "?act=ctsp&id=<?= $pro_id ?>";
                </script>
                <?php
                return;
            }
            if (!$pro_size) {
                ?>
                <script>
                    alert("Vui lòng chọn kích cỡ");
                    window.location.href = "?act=ctsp&id=<?= $pro_id ?>";
                </script>
                <?php
                return;
            }
            if (!$pro_color) {
                ?>
                <script>
                    alert("Vui lòng chọn màu sắc");
                    window.location.href = "?act=ctsp&id=<?= $pro_id ?>";
                </script>
                <?php
                return;
            }
            // Lấy chi tiết sản phẩm
            $pro_detail_one = $this->productDetailQuery->infoOneProductDetail_color_size_proID($pro_id, $pro_size, $pro_color);

            // Kiểm tra số lượng trong kho
            if ($pro_detail_one->pro_quantity <= $soluong) {
                ?>
                <script>
                    alert("Quá số lượng hàng còn trong kho");
                    window.location.href = "?act=ctsp&id=<?= $pro_detail_one->pro_id ?>";
                </script>
                <?php
                return;
            }
            $total = $pro_detail_one->pro_price * $soluong;

            $array_pro = [
                'product_dt_id' => $pro_detail_one->product_dt_id,
                'pro_img' => $pro_detail_one->pro_image,
                'pro_color' => $pro_detail_one->pro_color,
                'pro_size' => $pro_detail_one->pro_size,
                'pro_name' => $pro_detail_one->pro_name,
                'pro_price' => $pro_detail_one->pro_price,
                'pro_quantity' => $pro_detail_one->pro_quantity,
                'soluong' => $soluong,
                'total' => $total,
            ];
            // Kiểm tra nếu giỏ hàng đã có trong session
            if (isset($_SESSION["myCart"])) {
                $proInCart = "";

                // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
                foreach ($_SESSION["myCart"] as $key => $proCart) {
                    if ($array_pro['product_dt_id'] == $proCart['product_dt_id']) {
                        $proCart['soluong'] += $array_pro['soluong'];
                        $soluongIncart = $proCart['soluong'];
                        $totalProIncart = $soluongIncart * $proCart['pro_price'];
                        // Cập nhật giỏ hàng trong session
                        $array_pro = [
                            'product_dt_id' => $pro_detail_one->product_dt_id,
                            'pro_img' => $pro_detail_one->pro_image,
                            'pro_color' => $pro_detail_one->pro_color,
                            'pro_size' => $pro_detail_one->pro_size,
                            'pro_name' => $pro_detail_one->pro_name,
                            'pro_price' => $pro_detail_one->pro_price,
                            'pro_quantity' => $pro_detail_one->pro_quantity,
                            'soluong' => $soluongIncart,
                            'total' => $totalProIncart,
                        ];
                        $proInCart = 1;
                        $_SESSION["myCart"][$key] = $array_pro;
                    }
                }
                // Nếu sản phẩm chưa có trong giỏ, thêm mới vào giỏ
                if ($proInCart !== 1) {
                    array_push($_SESSION["myCart"], $array_pro);
                } else {
                    // Xóa sản phẩm cũ trong giỏ và thêm sản phẩm mới
                    foreach ($_SESSION["myCart"] as $key => $proCart) {
                        if ($array_pro['product_dt_id'] == $proCart['product_dt_id']) {
                            unset($_SESSION["myCart"][$key]);
                            break;
                        }
                    }
                    array_push($_SESSION["myCart"], $array_pro);
                }
            } else {
                array_push($_SESSION["myCart"], $array_pro);
            }
        }
        $allSlPro = 0;
        $tongTien = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
                $tongTien += $proCart['total'];
            }
        }
        include "view/cart.php";
    }
    public function order()
    {
        if (empty($_SESSION['myCart'])) {
            header('Location: index.php') . '';
            return;
        }
        $allSlPro = 0;
        $array = [];
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        $dsCategory = $this->categoryQuery->all();

        if (isset($_POST['submitInforCart'])) {
            $index = 0;
            $lastIndex = $_POST['lastIndex'];
            $tongTien = $_POST['tongTien'];

            $timeNow = date('Y-m-d H:i:s');
            $mang = [];
        }
        foreach ($array as $key => $checkSL) {
            $product_dt_id_one = $this->productDetailQuery->infoOneProductDetail($checkSL['product_dt_id']);

            if ($product_dt_id_one->pro_quantity - $checkSL['soluong'] <= 1) {
                ?>
                <script>
                    var product_dt_id_one = <?php echo json_encode($product_dt_id_one); ?>;
                    alert("Quá số lượng hàng còn trong kho tại sản phẩm: <?= $product_dt_id_one->pro_name ?> \n Xin lỗi vì sự bất tiện này, chúng tôi xin phép được liên hệ với quý khách sớm nhất để trao đổi thêm!");
                    // alert("");
                    window.location.href = "?act=cart";
                </script>
                <?php

                return;
            }
            if ($checkSL['soluong'] > 10) {
                ?>
                <script>
                    alert("Xin lỗi vì sự bất tiện này, không thể đặt một lúc quá 10 sản phẩm.\n Nhân viên sẽ sớm liên hệ với quý khách để trao đổi thêm");
                    window.location.href = "?act=cart";
                </script>
                <?php
                return;
            }
        }
        $check = "";
        if (isset($_SESSION['acc_email'])) {
            $email = $_SESSION['acc_email'];
            // var_dump( $email);
            $acc_id = $_SESSION['acc_id'];
            $check = 1;
        } else {
            $check = 0;
        }
        include "view/order.php";
    }
    public function end_order()
    {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        if (isset($_POST['btn_DatHang'])) {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $bill_total = $_POST['bill_total'];
            $acc_id = $_POST['acc_id'];
            $payment_method = $_POST['payment_method'];
            $date_order = date('Y-m-d H:i:s');
            $bill_status = 1;
            $bill_id = $this->billQuery->insert_bill($fullname, $phone, $address, $date_order, $bill_total, $acc_id, $bill_status, $payment_method);

            if ($bill_id) {
                $tongTien = 0;
                foreach ($_SESSION["myCart"] as $key => $product) {
                    $tongTien = $product['pro_price'] * $product['soluong'];
                    $this->billDetailQuery->add_bill_detail($product['pro_name'], $product['pro_price'], $product['soluong'], $tongTien, $bill_id, $product['product_dt_id']);
                }
            } else {
                echo "Lỗi khi đặt hàng!";
            }

            unset($_SESSION['myCart']);
        }

        include "view/end_order.php";
    }
    public function deleteOneProInCart()
    {
        //lấy danh sách danh mục
        $dsCategory = $this->categoryQuery->all();
//kiểm tra id có sản phẩm không
        if (isset($_GET['product_dt_id'])) {
            $product_dt_id = $_GET['product_dt_id'];
            //Vòng lặp foreach sẽ duyệt qua tất cả các sản phẩm trong giỏ hàng.
              //Nếu product_dt_id của sản phẩm trong giỏ hàng khớp với ID sản phẩm mà người dùng muốn xóa,
              // hàm unset sẽ được gọi để xóa sản phẩm đó khỏi giỏ hàng.
            foreach ($_SESSION["myCart"] as $key => $proCart) {
                if ($proCart['product_dt_id'] == $product_dt_id) {
                    unset($_SESSION['myCart'][$key]);
                }
            }
        }
        $allSlPro = 0;
        $tongTien = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
                $tongTien += $proCart['total'];
            }
        }
        include "view/cart.php";
    }
    public function deleteAllCart()
    {
        if (isset($_SESSION["myCart"]) && ($_SESSION["myCart"]) > 0) {
            unset($_SESSION["myCart"]);
            header("Location: ?act=cart");
        } else {
            echo "xóa thất bại";
        }
    }
    public function viewProfile()
    {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        if (isset($_SESSION['acc_id'])) {
            $info = $this->accountQuery->infoOneAccount($_SESSION['acc_id']);
            $dsOrder = $this->billQuery->showBillOfAcc($_SESSION['acc_id']);
        }
        $dsCategory = $this->categoryQuery->all();
        include "view/profile.php";
    }
    public function updateProfile()
    {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        $dsCategory = $this->categoryQuery->all();

      
        if (isset($_POST['updateFormProfile'])) {
            $email = $_POST["acc_email"];
            $account = new Account();
            $account->acc_name = trim($_POST["acc_name"]);
            $account->acc_password = trim($_POST["acc_password"]);
            $account->acc_phone = trim($_POST["acc_phone"]);
            $account->acc_image = "";
            if (isset($_FILES["image_upload"]) && ($_FILES["image_upload"]["tmp_name"]) !== "") {
                $img = $_FILES["image_upload"]["tmp_name"];
                $vi_tri = "img/account/" . time() . "_" . $_FILES["image_upload"]["name"];
                if (move_uploaded_file($img, $vi_tri)) {
                    echo "Upload image thành công";
                    $account->acc_image = time() . "_" . $_FILES["image_upload"]["name"];
                } else {
                    echo "Upload image thất bại";
                }
                $result = $this->accountQuery->updateProfile($account, $email);
                $_SESSION['acc_name'] = $_POST["acc_name"];
            } else {
                $result = $this->accountQuery->updateProfile_NoImg($account, $email);
            }
            header("Location: ?act=view_profile");
        }

        include "view/updateProfile.php";
    }
    public function searchPro()
    {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        $dsCategory = $this->categoryQuery->all();
        if (isset($_POST['searchKeyPro'])) {
            $key = $_POST['searchPro'];
            $dsPro_search = $this->productQuery->searchPro($key);
            include "view/searchPro.php";
        } else {
            include "view/home.php";
        }
    }
    public function showAllProOfCate()
    {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        $dsCategory = $this->categoryQuery->all();
        if (isset($_GET['cate_id'])) {
            $dsAllProduct_same = $this->productQuery->getAllProSameCate_id($_GET['cate_id']);
            // echo "<Pre>";
            // print_r($dsAllProduct_same);
            $cate_one = $this->categoryQuery->show_one_cate($_GET['cate_id']);

            include "view/showProInCate.php";
        }

    }
}
?>
