<?php

    class HomeController {
        public $categoryQuery;
        public $productQuery;
        public $productDetailQuery;
        public $accountQuery;
<<<<<<< HEAD
        public $newsQuery;
=======
        public $commentQuery;
        public $newsQuery;
  

>>>>>>> 42190961c3bc69b2050fec0fdfdca336c8db1586
        public function __construct()
        {
            $this->productQuery = new ProductQuery();
            $this ->productDetailQuery = new ProductDetailQuery();
            $this->categoryQuery = new CategoryQuery();
            $this -> accountQuery = new AccountQuery();
            $this -> newsQuery= new NewsQuery();
        }
        public function __destruct()
        {
            
        }
        public function cart() {
            $dsCategory = $this->categoryQuery->all();
                if (isset($_POST['addToCart'])) {
                    // echo "<Pre>";
                    // print_r($_POST);
                    $pro_size = $_POST['pro_size'];
                    $pro_color = $_POST['pro_color'];
                    $pro_id = $_POST['pro_id'];
                    $soluong = $_POST['soluong']; 
                    if (!$pro_color && !$pro_size) {
                        ?>
                            <script>
                                alert("Vui lòng chọn màu sắc và kích cỡ");
                                window.location.href = "?act=ctsp&id=<?=$pro_id?>";
                            </script>
                        <?php
                         return;
                    }
                    if (!$pro_size) {
                        ?>
                            <script>
                                alert("Vui lòng chọn kích cỡ");
                                window.location.href = "?act=ctsp&id=<?=$pro_id?>";
                            </script>
                        <?php
                        return;
                    } 
                    if (!$pro_color) {
                        ?>
                            <script>
                                alert("Vui lòng chọn màu sắc");
                                window.location.href = "?act=ctsp&id=<?=$pro_id?>";
                            </script>
                        <?php
                         return;
                    } 
                    $pro_detail_one = $this->productDetailQuery->infoOneProductDetail_color_size_proID($pro_id,$pro_size,$pro_color);
                    if ($pro_detail_one->pro_quantity <= $soluong) {
                        ?>
                            <script>
                                alert("Quá số lượng hàng còn trong kho");
                                window.location.href = "?act=ctsp&id=<?=$pro_detail_one->pro_id?>";
                            </script>
                        <?php
                        return;
                    } 
                    $total = $pro_detail_one->pro_price * $soluong;
                    
                    $array_pro = [
                        'product_dt_id' =>$pro_detail_one->product_dt_id,
                        'pro_img'=> $pro_detail_one->pro_image,
                        'pro_color' =>$pro_detail_one->pro_color,
                        'pro_size' =>$pro_detail_one->pro_size,
                        'pro_name'=> $pro_detail_one->pro_name,
                        'pro_price'=> $pro_detail_one->pro_price,
                        'pro_quantity'=> $pro_detail_one->pro_quantity,
                        'soluong' => $soluong,
                        'total'=> $total,
                    ];
    
                    if (isset($_SESSION["myCart"])) {
                        $proInCart = "" ;
                        foreach ($_SESSION["myCart"] as $key => $proCart) {
                            if ($array_pro['product_dt_id'] == $proCart['product_dt_id']) {
                                $proCart['soluong'] += $array_pro['soluong'];
                                $soluongIncart = $proCart['soluong'];
                                $totalProIncart = $soluongIncart * $proCart['pro_price'];
    
                                $array_pro = [
                                    'product_dt_id' =>$pro_detail_one->product_dt_id,
                                    'pro_img'=> $pro_detail_one->pro_image,
                                    'pro_color' =>$pro_detail_one->pro_color,
                                    'pro_size' =>$pro_detail_one->pro_size,
                                    'pro_name'=> $pro_detail_one->pro_name,
                                    'pro_price'=> $pro_detail_one->pro_price,
                                    'pro_quantity'=> $pro_detail_one->pro_quantity,
                                    'soluong' => $soluongIncart,
                                    'total'=> $totalProIncart,
                                ];
                                $proInCart = 1;
                                $_SESSION["myCart"][$key] = $array_pro;
                            }
                            // break;
                        }
                        if ($proInCart !== 1) {
                            array_push($_SESSION["myCart"],$array_pro);
                        } else {
                            array_push($_SESSION["myCart"],$array_pro);
                            // echo "<pre>";
                            // print_r($_SESSION["myCart"]);
                            foreach ($_SESSION["myCart"] as $key => $proCart) {
                                if ($array_pro['product_dt_id'] == $proCart['product_dt_id']) {
                                    unset($_SESSION["myCart"][$key]);
                                    break;
                                }
                            }
                        }
                    } else{
                        array_push($_SESSION["myCart"],$array_pro);
                    }
                    // echo "<pre>";
                    // print_r($_SESSION['myCart']);
                    $allSlPro = 0;
                    foreach ($_SESSION["myCart"] as $key => $proCart) {
                        if ($proCart['product_dt_id']) {
                            $allSlPro++;
                        }
                    }
                    // print_r($allSlPro);
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


               
                
                    
                
            }
            include "view/ctsp.php";
        }
    public function deleteOneProInCart() {
        $dsCategory = $this->categoryQuery->all();

        if (isset($_GET['product_dt_id'])) {
            $product_dt_id = $_GET['product_dt_id'];
            // var_dump($product_dt_id);
            foreach ($_SESSION["myCart"] as $key => $proCart) {
                  if ($proCart['product_dt_id'] ==  $product_dt_id) {
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
    public function deleteAllCart() {
        if(isset($_SESSION["myCart"]) && ($_SESSION["myCart"]) > 0) {
            unset($_SESSION["myCart"]);
            header("Location: ?act=cart");
        } else {
            echo "xóa thất bại";
        }
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

    public function searchPro() {
        $allSlPro = 0;
        foreach ($_SESSION["myCart"] as $key => $proCart) {
            if ($proCart['product_dt_id']) {
                $allSlPro++;
            }
        }
        $dsCategory = $this->categoryQuery->all();
        if (isset($_POST['searchKeyPro'])) {
            // echo "<Pre>";
            // print_r($_POST);
            $key = $_POST['searchPro'];
            $dsPro_search = $this->productQuery->searchPro($key);
            //  echo "<Pre>";
            // print_r($dsPro_search);
            include "view/searchPro.php";
        } else {
            include "view/home.php";
        }
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
            // echo "<Pre>";
            // print_r($dsAllProduct_same);
        $cate_one = $this->categoryQuery->show_one_cate($_GET['cate_id']);

            include "view/showProInCate.php";
        }
       
    }


}
?>