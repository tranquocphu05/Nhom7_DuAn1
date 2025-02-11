<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="img/logo_darkblue_notfull.svg" type="image/x-icon">
    <link rel="stylesheet" href="giaodien/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/6dab569175.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>

<body>
    <?php
        include "view/Component/header.php"
    ?>
    <main>
        <div class="banner w95">
            <div class="banner_slideshow">
                <img src="img/banner.jpg" alt="">
            </div>
            <div class="banner_content">
    <h3 class=""><span></span>Giày Tây 2024</h3>
    <h1>Phong cách & Đẳng cấp</h1>
    <p>Giày tây là sự lựa chọn hoàn hảo cho những ai yêu thích sự thanh lịch, sang trọng và lịch lãm. Những thiết kế mới nhất trong năm 2024 hứa hẹn sẽ mang đến cho bạn sự tự tin và phong cách nổi bật, phù hợp với mọi sự kiện và môi trường làm việc.</p>
    <h3><a href="">Mua ngay</a></h3>
</div>

        </div>
        <div class="category w95">
            <div class="bigcate">
                <a href="">
                    <div class="img_cate">
                        <img src="img/cate1.jpg" alt="">
                    </div>
                    <div class="cate_info">
                        <h3>Giày Tây</h3>
                    </div>
                </a>
            </div>
            <div class="smallcate">
                <div class="cate_item">
                    <a href="">
                        <div class="img_cate">
                            <img src="img/cate2.jpg" alt="">
                        </div>
                        <div class="cate_info">
                            <h3>Áo Vest Nam</h3>
                        </div>
                    </a>
                </div>
                <div class="cate_item">
                    <a href="">
                        <div class="img_cate">
                            <img src="img/cate3.jpg" alt="">
                        </div>
                        <div class="cate_info">
                            <h3>Quần Âu Tây</h3>
                        </div>
                    </a>
                </div>
                <div class="cate_item">
                    <a href="">
                        <div class="img_cate">
                            <img src="img/cate4.jpg" alt="">
                        </div>
                        <div class="cate_info">
                            <h3>Cavast</h3>
                        </div>
                    </a>
                </div>
                <div class="cate_item">
                    <a href="">
                        <div class="img_cate">
                            <img src="img/cate5.jpg" alt="">
                        </div>
                        <div class="cate_info">
                            <h3>Bộ Vest Nam Sẵn</h3>
                        </div>
                    </a>
                </div>
                <!-- End cate_item -->
            </div>
        </div>
        <!-- End category -->
        <div class="hot_products w95">
            <div class="title">sản phẩm bán chạy</div>
            <div class="typeshow">
                <ul>
                    <li><a href="">Tất cả</a></li>
                    <li><a href="">Nổi bật</a></li>
                    <li><a href="">Bán chạy</a></li>
                    <li><a href="">Giảm giá</a></li>
                </ul>
            </div>
            <a href=""><h4>xem tất cả sản phẩm</h4></a>
        </div>
        <div class="bigdeal">
            <a href="">
                <div class="title_deal">
                    <h1>living room furniture</h1>
                    <p>Discount 50%</p>
                </div>
                <div class="img_deal">
                    <img src="img/deal_banner.jpg" alt="">
                </div>
            </a>
        </div>
        <div class="last_news">
            <div class="title_news">
                tin mới nhất
            </div>
         
        </div>
        <div class="brand">
            <img src="img/brand1.png" alt="">
            <img src="img/brand2.png" alt="">
            <img src="img/brand3.png" alt="">
            <img src="img/brand4.png" alt="">
            <img src="img/brand6.png" alt="">
            <img src="img/brand7.png" alt="">
            <img src="img/brand1.png" alt="">
        </div>
        <div class="insta w95">
            <div class="linked_insta">
                <a href="">
                    <button>
                        <i class="fa-brands fa-instagram"></i>
                        Instagram
                    </button>
                </a>
            </div>
            <div class="img_insta">
                <img src="img/ins1.jpg" alt="">
                <img src="img/ins2.jpg" alt="">
                <img src="img/ins3.jpg" alt="">
                <img src="img/ins4.jpg" alt="">
                <img src="img/ins5.jpg" alt="">
                <img src="img/ins6.jpg" alt="">
                <img src="img/ins7.jpg" alt="">
                <img src="img/ins8.jpg" alt="">
            </div>
        </div>
        <div class="hot_privacy">
            <div class="privacy_item">
                <i class="fa-solid fa-truck-fast"></i>
                <div class="name_privacy">
                    <h6>giao hàng nhanh và miễn phí</h6>
                    <p>Giao hàng miễn phí đơn hàng trên 1000k</p>
                </div>
            </div>
            <div class="privacy_item">
                <i class="fa-solid fa-headphones"></i>
                <div class="name_privacy">
                    <h6>hỗ trợ khách hàng 24/7</h6>
                    <p>Hỗ trợ khách hàng thân thiện 24/7</p>
                </div>
            </div>
            <div class="privacy_item">
                <i class="fa-solid fa-circle-check"></i>
                <div class="name_privacy">
                    <h6>hoàn tiền nhanh chóng</h6>
                    <p>Trả lại tiền trong vòng 30 ngày</p>
                </div>
            </div>
        </div>
        <hr>
    </main>
   
    <?php
        include "view/Component/footer.php"
    ?>
</body>

</html>