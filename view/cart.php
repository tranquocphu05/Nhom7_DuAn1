<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="shortcut icon" href="img/logo_darkblue_notfull.svg" type="image/x-icon">
    <link rel="stylesheet" href="giaodien/Clientstyle.css">
    <link rel="stylesheet" href="giaodien/home.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/6dab569175.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include "view/component/header.php";
    ?>

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
    <!-- Main content -->
    <main class="container">
        <div class="" style="text-align:center;">
            <h4>MY CART </h4>
        </div>
        <div class="d-flex justify-content-between mb-3" style="float:right;">
            <div>
                <a onclick="return confirm('Xác nhận xóa toàn bộ sản phẩm trong giỏ hàng?')" 
                    href="index.php?act=deleteAllcart">
                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i> Xóa giỏ hàng </button>
                </a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Đơn Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Số Tiền</th>
                    <th scope="col" class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                    <form action="?act=order" method="post" id="cartForm">
                <?php

                if (isset($_SESSION['myCart'])) {
                    $index = 0; 

                    foreach ($_SESSION['myCart'] as $pro) : ?>
                    <tr>
                        <th scope="row" style="width: 50%;">
                            <input type="checkbox" class="me-2">
                            <img src="img/product/<?= $pro['pro_img'] ?>" width="10%" alt="">
                            <input type="text" name="imgInCart<?= $index ?>" value="img/product/ <?= $pro['pro_img'] ?>"
                                hidden>
                            <input type="text" name="product_dt_id<?= $index ?>" value="<?= $pro['product_dt_id'] ?>"
                                hidden>
                            <span>
                                <?= $pro['pro_name'] ?> : <?= $pro['pro_color'] ?> <?= $pro['pro_size'] ?>
                                <input type="text"
                                    value="<?= $pro['pro_name'] ?> : <?= $pro['pro_color'] ?> <?= $pro['pro_size'] ?>"
                                    name="pro_inf<?= $index ?>" hidden>
                            </span>
                        </th>
                        <td>
                            <div class="d-flex text-center">
                                <span class="text-black fw-bold pe-2"><?= $pro['pro_price'] ?></span>
                            </div>
                        </td>
                        <td>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination d-flex">
                                    <!-- <li class="page-item">
                                        <a class="page-link text-success" aria-label="Next">
                                            <span> - </span>
                                        </a>
                                    </li> -->
                                    <li class="page-item">
                                        <a class="page-link text-success" href="#">
                                            <?= $pro['soluong'] ?>
                                            <input type="number" value="<?= $pro['soluong'] ?>"
                                                name="soluongincart<?= $index ?>" hidden>
                                        </a>
                                    </li>
                                    <!-- <li class="page-item">
                                        <a class="page-link text-success" aria-label="Previous">
                                            <i class="fa-solid fa-plus fa-xs"></i>
                                        </a>
                                    </li> -->
                                </ul>
                            </nav>
                        </td>
                        <td style="font-weight: 600;">
                            <?= $pro['total'] ?>.000
                            <input type="number" value="<?= $pro['total'] ?>.000" name="totalOnePro<?= $index ?>"
                                hidden>
                        </td>
                        <td>
                        <a href="#" class="delete-link" data-url="index.php?act=deleteProInCart&product_dt_id=<?= $pro['product_dt_id'] ?>">
                            <button class="btn btn-danger" style="margin-left: 10px;" name="deleteProIncart" onclick="changeAction(event)">Xóa</button>
                        </a>
                    </tr>
                    <?php
                  
                    endforeach;
                   
                }
                ?>
                    <input type="number" value="<?=$lastIndex?>" name="lastIndex" hidden>
                    <td></td>
                    <td></td>
                    <td style="font-weight: 800; font-size: 20px;">
                        Tổng tiền : <?= $tongTien ?> .000đ
                        <input type="text" name="tongTien" value="<?= $tongTien ?>" hidden>
                    </td>
                    <td></td>
                    <td class="text-center">
                        <a href="">
                            <button class="btn bg-success" style="color: #fff;" name="submitInforCart">Đặt hàng</button>
                        </a>
                    </td>
                </form>
            </tbody>
        </table>

    </main>

    <!-- End main content -->
    </main>
    <!-- FOOTER -->
    <?php
    include "view/component/footer.php";
    ?>

</body>

</html>