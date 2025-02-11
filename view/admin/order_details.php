<!-- Kiểm tra nếu có dữ liệu đơn hàng -->
<?php if (!empty($orderDetails)): ?>
    <h1>Chi tiết đơn hàng #<?php echo htmlspecialchars($orderDetails[0]['order_id']); ?></h1>
    
    <p><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($orderDetails[0]['customer_name']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($orderDetails[0]['customer_email']); ?></p>
    <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($orderDetails[0]['customer_phone']); ?></p>
    <p><strong>Tổng tiền:</strong> <?php echo number_format($orderDetails[0]['order_total'], 0, ',', '.'); ?> VND</p>
    <p><strong>Trạng thái đơn hàng:</strong> <?php echo htmlspecialchars($orderDetails[0]['order_status']); ?></p>
    <p><strong>Trạng thái thanh toán:</strong> <?php echo htmlspecialchars($orderDetails[0]['payment_status']); ?></p>
    <p><strong>Phương thức thanh toán:</strong> <?php echo htmlspecialchars($orderDetails[0]['payment_method']); ?></p>
    <p><strong>Ngày tạo:</strong> <?php echo htmlspecialchars($orderDetails[0]['order_date']); ?></p>

    <h2>Chi tiết sản phẩm:</h2>
    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Biến thể</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng giá</th>
                <th>Ảnh sản phẩm</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderDetails as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['variant_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                    <td><?php echo number_format($item['total_price'], 0, ',', '.'); ?> VND</td>
                    <td><img src="<?php echo htmlspecialchars($item['product_image']); ?>" alt="product image" width="100"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Không tìm thấy đơn hàng này.</p>
<?php endif; ?>
view/admin/order_details.php