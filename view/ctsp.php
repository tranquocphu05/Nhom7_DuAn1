<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="shortcut icon" href="img/logo_darkblue_notfull.svg" type="image/x-icon">
    <link rel="stylesheet" href="giaodien/home.css">
    <link rel="stylesheet" href="giaodien/chiTietSP.css">
    <link rel="stylesheet" href="giaodien/comment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/6dab569175.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

</head>
</head>
<body>
    <?php include "view/Component/header.php" ?>

    <!-- End header -->

    <!-- Begin main  -->

    <div class="row1">
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="#"><i class="fa-solid fa-angle-right"></i></a></li>
            <li>
                <?php
                    if ($pro_one->cate_status == 1) {
                ?>
                <a href="">
                    <?= $pro_one->cate_name?>
                </a>
                <?php
                    } else { 
                ?>
                <a href="">
                    Không danh mục
                </a> 
                <?php
                    }
                ?>
            </li>
            <li><a href=""><i class="fa-solid fa-angle-right"></i></a></li>
            <li><a href=""><?= $pro_one->pro_name ?></a></li>
        </ul>
    </div>
    <main>


        <div class="row2">
            <div class="row2_img">
                <img  src="img/product/<?= $pro_one->pro_image?>" alt="">
            </div>

            <div class="pro_inf">
                <h4><?= $pro_one->pro_name?></h4>

                <!-- <h5 style="color: black; font-size: 20px;">
                    Giá: <span style="color: red;"><?=$price ?></span>
                </h5> -->

                <?php
                    if ($price < $price_max) { ?>
                        <h5><?=$price ?> - 
                        <?=$price_max ?> <span style=" font-size: 18px;font-weight:800"> VND</span>
                        </h5>

                 <?php   } else { ?>
                    <h5><?=$price ?><span style=" font-size: 18px;font-weight:800"> VND</span>
                        </h5>
               <?php  }
                ?>

                <div class="inf">
                    <div class="id">
                        <label for="">Mã sản phẩm:</label>
                        <span><?= $pro_one->pro_id?></span>
                    </div>
                    <div class="cate">
                        <label for="">Danh mục:</label>
                        <span><?php
                    if ($pro_one->cate_status == 1) {
                         ?>
                            <?= $pro_one->cate_name ?>
                            <?php
                    } else { ?>
                            Không danh mục
                            <?php
                    }
                    ?></span>
                    </div>
                    <div class="mota">
                        <?= $pro_one->pro_description?>
                    </div>
                </div>

                <div class="form">
                    <form action="?act=cart" method="post">
                        <input type="text" name="pro_id" value="<?= $pro_one->pro_id?>" hidden>
                        <div class="color">
                            <label for="">
                                <h3>Màu sắc</h3>
                            </label>
                            <div class="box_color">
                                <?php
                                    $arayColor = [];
                                     foreach ($dsProDetail as $pro_dt_list) {
                                        
                                        if (!in_array($pro_dt_list-> pro_color,$arayColor)) {
                                            $arayColor[] =   $pro_dt_list-> pro_color
                                        }
                                     }
                                    //  var_dump($arayColor);
                                ?>
                                <?php foreach ($arayColor as $color) : ?>
                                <input type="radio" value="<?= $color?>" name="pro_color" id="<?=$color?>" hidden
                                    class="color">
                                <label id="label" for="<?=$color?>"
                                    style="width: 100px; height: 40px; border-radius: 20px; border: 1px solid black; text-align: center;
                                     line-height: 40px; cursor: pointer; margin-right: 10px; background-color: #fff;"><?=$color?></label>
                                <?php endforeach; ?>

                            </div>
                        </div>

                        <div class="size">
                            <label for="">
                                <h3>Kích cỡ</h3>
                            </label>

                            <div class="box_size">
                                <?php
                                    $araySize = [];
                                     foreach ($dsProDetail as $pro_dtlist) {
                                        
                                        if (!in_array($pro_dt_list->pro_size,$araySize)) {
                                            $araySize[] =   $pro_dt_list-> pro_size;
                                        }
                                     }
                                    //  var_dump($araySize);
                                ?>
                                <?php foreach ($araySize as $size) : ?>
                                <input type="radio" value="<?= $size?>" name="pro_size" id="<?=$size?>" hidden
                                    class="size">
                                <label id="label1" for="<?=$size?>"
                                    style="width: 100px; height: 40px; border-radius: 20px; border: 1px solid black; text-align: center;
                                     line-height: 40px; cursor: pointer; margin-right: 10px; background-color: #fff;"><?=$size?></label>
                                <?php endforeach; ?>

                            </div>

                            <div class="box_sl" style="margin-top: 20px;">

                                <label for="quantity" style="text-align: center;padding: 10px;font-weight: 500;
                                font-size: 18px;  ">Số lượng sản phẩm:</label>
                                <input type="number" id="quantity" name="soluong" min="1" max="10" value="1"
                                    style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 100px;">

                            </div>
                        </div>
                        <div class="contact">
                            <!-- <div class="phone">
                                <i class="fa-solid fa-phone"></i>
                                1900 6868
                            </div> -->
                            <div class="buy">
                                <a href="">
                                    <button type="submit" name='addToCart'>Thêm vào giỏ Hàng</button>
                                </a>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="icon">
                    <ul>
                        <li><a href="">Chia sẻ:</a></li>
                        <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row3">
            <h3>Thông tin sản phẩm</h3>
            <div class="pro_description">
                <?= $pro_one->pro_description?>
            </div>
        </div>

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                    $("#comment").load("view/form_comment.php", { pro_id: <?= $pro_one->pro_id ?> });
            });
        </script> -->
       

        <div class="hot_products w95">
            <div class="title">Sản phẩm liên quan</div>

            <div class="list_pro">
                <?php
                    // var_dump($dsProduct_same);
                    foreach ($dsProduct_same as $pro_same) : ?>
                <div class="pro_item">
                    <div class="quick_act">
                        <form action="">
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-cart-shopping"></i></button>
                            <button><i class="fa-regular fa-eye"></i></button>
                        </form>
                    </div>
                    <div class="img_pro">
                        <a href="?act=ctsp&id=<?= $pro_same->pro_id?>"><img src="img/product/<?=$pro_same->pro_image?>"
                                alt=""></a>
                    </div>
                    <div class="content_pro">
                        <div class="name_pro">
                            <a href="?act=ctsp&id=<?= $pro_same->pro_id?>"><?=$pro_same->pro_name?></a>
                        </div>
                        <div class="price_pro">
                            <p>Liên hệ <span></span></p>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>

                <!-- End pro_item -->
            </div>
        </div>



    </main>

    <!-- footer -->

    <?php
        include "view/Component/footer.php"
    ?>
</body>

</html>