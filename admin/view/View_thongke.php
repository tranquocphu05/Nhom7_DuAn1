<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/be9ed8669f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../giaodien/style.css">
    <style>
        /* Đảm bảo phần tử chứa biểu đồ có kích thước chiều rộng cố định */
        #columnchart {
            width: 1110px;  /* Chiều rộng của biểu đồ là 870px */
            height: 600px; /* Chiều cao có thể thay đổi theo nhu cầu */
            margin: auto;  /* Để căn giữa biểu đồ */
        }
        
    /* style.css */

/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #333;
}

h3 {
    margin-bottom: 20px;
    color: #007bff;
}

/* Table Styles */
.table {
    margin-bottom: 30px;
    border-radius: 5px;
    overflow: hidden;
}

.table th, .table td {
    text-align: center;
    vertical-align: middle;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Chart Styles */
#piechart {
    width: 100%;
    height: 400px;
    margin: auto;
}

/* Responsive Design */
@media (max-width: 768px) {
    .table, .bieudo1, .bieudo2 {
        width: 100%;
        overflow-x: auto;
    }

    .bieudo1, .bieudo2 {
        padding: 0 10px;
    }
}

    </style>
</head>

<body>
    <?php include "view/component/header.php"; ?>
    <!-- END HEADER -->

    <!-- CONTENT -->
    <main class="d-flex container">
        <!-- Sidebar trái -->
        <?php include "view/component/sidebar.php"; ?>

        <!-- Main content -->
        <div class="bieudo1 pt-4 ms-4 me-4">
            <div id="columnchart"></div>
        </div>

        <!-- End main content -->
    </main>
    <!-- FOOTER -->
    <?php include "view/component/footer.php"; ?>
    <!-- END FOOTER -->

    <!-- External JS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var rawData = [
                <?php
                foreach ($dsthongKe as $tk) {
                    // Xử lý NULL thành 0 và đảm bảo dữ liệu đúng format
                    $quantity = $tk->total_quantity ?? 0;
                    echo "['" . addslashes($tk->cate_name) . "', $quantity],";
                }
                ?>
            ];

            console.log(rawData);  // Kiểm tra dữ liệu

            var data = google.visualization.arrayToDataTable([
                ['Tên danh mục', 'Số lượng sản phẩm'],
                ...rawData
            ]);

            var options = {
                'title': 'Thống kê sản phẩm theo danh mục',
                'width': 1110, // Chiều rộng của biểu đồ là 870px
                'height': 600,  // Chiều cao của biểu đồ
                'legend': { position: 'none' },  // Tắt legend nếu không cần thiết
                'chartArea': { width: '80%' },  // Tăng kích thước vùng vẽ
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('columnchart'));
            chart.draw(data, options);
        }
    </script>
</body>

</html>
