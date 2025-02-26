<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="img/logo_darkblue_notfull.jpg" type="image/x-icon">
    <link rel="stylesheet" href="giaodien/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/6dab569175.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<style>
 .banner_content {
    color: white; /* Set the text color to white */
    font-family: Arial, sans-serif; /* Use a clean, modern font */
    text-align: center; /* Center the text */
    padding: 20px;
}

.banner_content h3 {
    font-size: 2rem; /* Make the h3 text larger */
    font-weight: bold; /* Make it bold */
}

.banner_content h1 {
    font-size: 4rem; /* Make the h1 text very large */
    font-weight: bold; /* Make it bold */
    letter-spacing: 2px; /* Add some spacing between the letters for a modern look */
    text-transform: uppercase; /* Capitalize the text for a more sophisticated style */
}

.banner_content p {
    font-size: 1.2rem; /* Set a readable font size */
    line-height: 1.5; /* Space out the lines for better readability */
    margin: 15px 0; /* Add some space around the paragraph */
}

.banner_content h3 a {
    text-decoration: none; /* Remove underline from link */
    color: white; /* Keep the link text white */
    font-size: 1.5rem; /* Make the link text larger */
    background-color: #f57c00; /* Add an orange background to make the link stand out */
    padding: 10px 20px; /* Add some padding to the link */
    border-radius: 5px; /* Round the corners */
    transition: transform 0.3s ease, background-color 0.3s ease; /* Smooth transition for zoom and background */
}

/* Hover state for the link with zoom effect */
.banner_content h3 a:hover {
    background-color: #e65100; /* Darker orange on hover */
    transform: scale(1.1); /* Zoom the button to 110% of its size */
}


.banner_slideshow .slide {
 
    display: none; /* Ẩn các ảnh mặc định */
}

.banner_slideshow .active {
    display: block; /* Hiển thị ảnh có class "active" */
}
.infinite-scroll {
    width: 100%;
    height: 50px; /* Chiều cao của vùng cuộn */
    overflow: hidden; /* Ẩn các phần tử ngoài vùng này */
    position: relative;
    background-color: #f1f1f1;
}

.scroll-list {
    display: flex;
    list-style-type: none;
    padding: 0;
    margin: 0;
    animation: scroll 10s linear infinite; /* Tạo hiệu ứng cuộn liên tục */
}

.scroll-list li {
    padding: 0 20px;
    line-height: 50px;
}

@keyframes scroll {
    0% {
        transform: translateX(0); /* Bắt đầu từ vị trí ban đầu */
    }
    100% {
        transform: translateX(-100%); /* Cuộn hết sang bên trái */
    }
}

</style>
<body>
    <?php
        include "view/Component/header.php"
    ?>
    <!-- End header -->
    <main>
        <div class="banner w95">
        <div class="infinite-scroll">
    <ul class="scroll-list">
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
        <li>Item 5</li>
        <li>Item 6</li>
        <li>Item 7</li>
        <li>Item 8</li>
    </ul>
</div>

        <div class="banner_slideshow">
    <img src="img/banner1.jpg" alt="Banner 1" class="slide">
    <img src="img/banner2.jpg" alt="Banner 2" class="slide">
    <img src="img/banner3.jpg" alt="Banner 3" class="slide">
</div>

            <!-- <div class="banner_content">
    <h3 class=""><span></span>Giày Tây 2024</h3>
    <h1>Phong cách & Đẳng cấp</h1>
    <p>Giày tây là sự lựa chọn hoàn hảo cho những ai yêu thích sự thanh lịch, sang trọng và lịch lãm. Những thiết kế mới nhất trong năm 2024 hứa hẹn sẽ mang đến cho bạn sự tự tin và phong cách nổi bật, phù hợp với mọi sự kiện và môi trường làm việc.</p>
    <h3><a href="">Mua ngay</a></h3>
</div> -->
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
            <div class="list_pro">
                <?php  foreach ($dsProduct as $key=>$pro)  :?>
                    <div class="pro_item">
                    <div class="quick_act">
                        <form action="">
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-cart-shopping"></i></button>
                            <button><i class="fa-regular fa-eye"></i></button>
                        </form>
                    </div>
                    <div class="img_pro">
                        <a href="?act=ctsp&id=<?= $pro->pro_id?>">
                            <img src="img/product/<?= $pro->pro_image?>" alt="">
                        </a>
                    </div>
                    <div class="content_pro">
                        <div class="name_pro">
                            <a href="?act=ctsp&id=<?= $pro->pro_id?>"><?= $pro->pro_name?></a>
                        </div>
                        <div class="price_pro">
                            <p>
                                <?php 
                                    foreach ($Arr_price as $index => $pr_min) {
                                        if ($key == $index) {
                                            echo ($pr_min); ?> VND<?php
                                        }
                                    }
                                ?>
                            <span></span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php  endforeach; ?>
               
          
                <!-- End pro_item -->
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
            <div class="list_news">
                <?php foreach ($dsNews as $key => $news ) :?>
                <div class="news_item">
                    <div class="img_news">
                        <a href=""><img src="img/<?= $news->news_img ?>" alt=""></a>
                    </div>
                    <div class="news_content">
                        <div class="main_title">
                            <a href="">
                                <?= $news->news_title ?>
                            </a>
                        </div>
                        <div class="date">
                            <i class="fa-solid fa-calendar-days"></i>
                            01 tháng 06, 2024
                        </div>
                        <div class="intro">
                            <?= $news->news_content ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
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
    <script>
    let slideIndex = 0;

    // Hàm để hiển thị hình ảnh theo index
    function showSlides() {
        let slides = document.querySelectorAll('.banner_slideshow .slide');
        
        // Ẩn tất cả các hình ảnh
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Hiển thị hình ảnh hiện tại
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1 }
        slides[slideIndex - 1].classList.add('active');
        
        // Chuyển hình ảnh sau mỗi 3 giây
        setTimeout(showSlides, 3000); // Thay đổi 3000ms (3 giây) nếu bạn muốn thay đổi thời gian
    }

    // Gọi hàm khi trang tải xong
    window.onload = function() {
        showSlides();
    };
</script>

</body>


</html>