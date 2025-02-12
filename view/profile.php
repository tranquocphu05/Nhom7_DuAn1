<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="img/logo_darkblue_notfull.svg" type="image/x-icon">
    <link rel="stylesheet" href="giaodien/home.css">
    <link rel="stylesheet" href="giaodien/sign_in.css">
    <link rel="stylesheet" href="giaodien/userDetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/6dab569175.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

</head>

<body>
    <?php
    include "view/Component/header.php"
    ?>
    <!-- End header -->
    <main>
        <nav>
            <ul>
                <li>
                    <a href="index.php">Trang chủ</a>
                    <i class="fa-solid fa-angle-right"></i>
                </li>
                <li>
                    <h5>Profile</h5>
                </li>
            </ul>
        </nav>
        <div class="profile">tài khoản cá nhân</div>
        <div class="main_content">
            <form action="?act=update_profile" method="POST" enctype="multipart/form-data" class="form-profile">
                <div class="avatar">
                    <?php
                    if ($info->acc_image == "") { ?>
                    <img src="img/account/user_default.png" alt="">
                    <?php  } else { ?>
                    <img src="img/account/<?= $info->acc_image ?>" alt="">
                    <?php  } ?>
                    <input type="text" name='acc_image' value="<?= $info->acc_image ?>" hidden>
                </div>
                <div class="detail_info">
                    <div class="hoten">Tên đăng kí: <?= $info->acc_name ?>
                        <input type="text" name='acc_name' value='<?= $info->acc_name ?>' hidden>
                    </div>
                    <div class="email">Email: <?= $info->acc_email ?>
                        <input type="email" name='acc_email' value='<?= $info->acc_email ?>' hidden>
                    </div>
                    <div class="password">Mật khẩu: *********
                        <input type="password" name='acc_password' value='<?= $info->acc_password ?>' hidden>
                    </div>
                    <div class="password">Số điện thoại: <?= $info->acc_phone ?>
                        <input type="text" name='acc_phone' value='<?= $info->acc_phone ?>' hidden>
                    </div>
                    
                </div>
                <a href="" class="btn-edit">
                    <button name='updateProfile'>chỉnh sửa</button>
                </a>
            </form>

        </div>

    </main>
    <hr>
</body>
<?php include "view/Component/footer.php" ?>

</html>