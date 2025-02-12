<?php

    class HomeController {
        public $categoryQuery;
        public $productQuery;
        public $productDetailQuery;
        public $accountQuery;
        public $billQuery;
        public $billDetailQuery;
        public $commentQuery;
        public $newsQuery;
        public $voucherQuery;

        public function __construct()
        {
            $this->productQuery = new ProductQuery();
            $this ->productDetailQuery = new ProductDetailQuery();
            $this->categoryQuery = new CategoryQuery();
            $this -> accountQuery = new AccountQuery();
            $this -> billQuery= new BillQuery();
            $this -> billDetailQuery= new BillDetailQuery();
            $this -> commentQuery= new CommentQuery();
            $this -> newsQuery= new NewsQuery();
            $this -> voucherQuery = new VoucherQuery();
        }

        public function __destruct()
        {
            
        }

        public function home() {
            $dsProduct = $this->productQuery->getTop16ProductLatest();
            $Arr_price = [];
            $mang_pro_id = [];
        
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
        
            // var_dump($Arr_price);
            // var_dump($mang_pro_id);
        
            // Tiếp tục các phần mã khác
            $dsCategory = $this->categoryQuery->all();
            $dsNews = $this->newsQuery->latestNews();
        
            include "view/home.php";
        }
        
        public function ctsp() {
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
                // var_dump($pro_one);
                // echo "<pre>";
                $cate_id = $pro_one->cate_id;
                $dsProDetail = $this->productDetailQuery->listProductDetail($pro_id);
                $dsProduct_same = $this->productQuery->getProductSameCate_id($cate_id);
                // var_dump($dsProDetail);

                $price = 1000000;

                foreach ($dsProDetail as $row) {

                    if ($row->pro_price < $price) {
                        $price = $row->pro_price;
                    }
                }

                $price_max =0;

                foreach ($dsProDetail as $row) {

                    if ($row->pro_price > $price_max) {
                        $price_max = $row->pro_price;
                    }
                }


                if(isset($_GET['id']) && isset($_GET['id']) > 0) {
                    $dsCmtPro = $this->commentQuery->commentFromOnePro($_GET['id']);
                }
                if(isset($_POST["submitFormCreateComment"])) {
                    if(!isset($_SESSION['acc_id'])){
                        ?>
                           
                        <?php
                    } else {
                        $comment = new Comment();  
                        $comment -> pro_id = trim($_POST["pro_id"]);
                        $comment -> com_content = trim($_POST["com_content"]);
                        $comment -> account_id = $_SESSION['acc_id'];
                        $comment -> com_date = date('Y-m-d H:i:s');
                        $result = $this -> commentQuery -> createComment($comment);
                        if ($result == "ok") {
                            header("Location:?act=ctsp&id=$pro_id");
                        } else {
                            echo "Tạo bình luận thất bại";
                        }
                    }
                }
                $countComment = $this -> commentQuery -> countCommentOnePro($_GET["id"]);
            }
            include "view/ctsp.php";
        }

 
 
    public function viewProfile() {
        $allSlPro = 0;
            foreach ($_SESSION["myCart"] as $key => $proCart) {
                if ($proCart['product_dt_id']) {
                    $allSlPro++;
                }
            }
        if(isset($_SESSION['acc_id'])) {
            // var_dump($_SESSION['acc_id']);
            $info = $this->accountQuery->infoOneAccount($_SESSION['acc_id']);
            $dsOrder = $this->billQuery->showBillOfAcc($_SESSION['acc_id']);
            // echo "<Pre>";
            // print_r($dsOrder);
        }




        $dsCategory = $this->categoryQuery->all();
        include "view/profile.php";
    }

    public function updateProfile() {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        $dsCategory = $this->categoryQuery->all();

        if (isset($_POST['updateProfile'])) {
            // echo "<Pre>";
            // print_r($_POST);
        }
        if (isset($_POST['updateFormProfile'])) {
            // echo "<Pre>";
            // print_r($_POST);
            $email = $_POST["acc_email"];
            // print_r($acc_email);
            $account = new Account();
            $account -> acc_name = trim($_POST["acc_name"]);
            $account -> acc_password = trim($_POST["acc_password"]);
            // $account -> acc_email = trim($_POST["acc_email"]);
            $account -> acc_phone = trim($_POST["acc_phone"]);
            $account -> acc_image = "";

            if (isset($_FILES["image_upload"]) && ($_FILES["image_upload"]["tmp_name"]) !== "") {
                $img = $_FILES["image_upload"]["tmp_name"];
                $vi_tri = "img/account/".time()."_".$_FILES["image_upload"]["name"];
                if (move_uploaded_file($img, $vi_tri)) {
                    echo "Upload image thành công";
                    $account -> acc_image = time()."_".$_FILES["image_upload"]["name"];
                } else {
                    echo "Upload image thất bại";
                }
                $result = $this -> accountQuery -> updateProfile($account, $email); 
                $_SESSION['acc_name'] = $_POST["acc_name"];
            } else {
                $result = $this -> accountQuery ->updateProfile_NoImg($account, $email); 
            }
            header("Location: ?act=view_profile");
        }

        include "view/updateProfile.php";
    }

    public function showAllProOfCate() {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        $dsCategory = $this->categoryQuery->all();
        if (isset($_GET['cate_id'])) {
            $dsAllProduct_same = $this->productQuery->getAllProSameCate_id($_GET['cate_id']);
        $cate_one = $this->categoryQuery->show_one_cate($_GET['cate_id']);

            include "view/showProInCate.php";
        }
       
    }

        }

?>

?>

