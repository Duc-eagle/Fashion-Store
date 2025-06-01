<?php
include_once('Config/connect.php');

if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    
    // Xử lý cập nhật trạng thái
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        $new_status = '';
        $message = '';
        
        switch($action) {
            case 'confirm':
                $new_status = 'Processing';
                $message = 'Đã xác nhận đơn hàng thành công!';
                break;
            case 'ship':
                $new_status = 'Shipping';
                $message = 'Đã chuyển sang trạng thái đang giao hàng!';
                break;
            case 'complete':
                $new_status = 'Completed';
                $message = 'Giao hàng thành công!';
                break;
            case 'cancel':
                $new_status = 'Cancelled';
                $message = 'Đã hủy đơn hàng!';
                break;
        }
        
        if($new_status) {
            $update_sql = "UPDATE orders SET order_status = '$new_status' WHERE order_id = $order_id";
            mysqli_query($connect, $update_sql);
            echo "<script>alert('$message');</script>";
        }
    }
    
    // Lấy thông tin đơn hàng và khách hàng
    $sql_order = "SELECT o.*, c.fullname, c.cus_phone, c.cus_address 
                  FROM orders o
                  LEFT JOIN customers c ON o.customer_id = c.cus_id
                  WHERE o.order_id = $order_id";
    $query_order = mysqli_query($connect, $sql_order);
    $order = mysqli_fetch_assoc($query_order);

    // Lấy chi tiết các sản phẩm trong đơn hàng
    $sql_details = "SELECT od.*, p.product_name, p.product_image1 
                   FROM order_details od
                   LEFT JOIN products p ON od.product_id = p.product_id
                   WHERE od.order_id = $order_id";
    $query_details = mysqli_query($connect, $sql_details);
}
?>

<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Chi tiết đơn hàng</h2>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                <i class="fa-solid fa-user"></i>
                <?= $_SESSION['username'] ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                <li><a class="dropdown-item" href="Layouts/Master/logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </div>

    <?php if(isset($order)): ?>
    <div class="order-info mt-4">
        <h4>Thông tin khách hàng</h4>
        <div class="customer-details">
            <p><strong>Người nhận:</strong> <?php echo $order['fullname']; ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $order['cus_phone']; ?></p>
            <p><strong>Địa chỉ:</strong> <?php echo $order['cus_address']; ?></p>
            <p><strong>Trạng thái:</strong> 
                <span class="status-badge <?php echo strtolower($order['order_status']); ?>">
                    <?php
                    switch($order['order_status']) {
                        case 'Pending': echo 'Chờ xác nhận'; break;
                        case 'Processing': echo 'Đã xác nhận'; break;
                        case 'Shipping': echo 'Đang giao hàng'; break;
                        case 'Completed': echo 'Đã giao hàng'; break;
                        case 'Cancelled': echo 'Đã hủy'; break;
                        default: echo $order['order_status'];
                    }
                    ?>
                </span>
            </p>
        </div>
    </div>

    <div class="order-details mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                $total = 0;
                while($detail = mysqli_fetch_assoc($query_details)): 
                    $subtotal = $detail['order_detail_price'] * $detail['order_details_amount'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $detail['product_name']; ?></td>
                    <td>
                        <img src="images/<?php echo $detail['product_image1']; ?>" 
                             alt="<?php echo $detail['product_name']; ?>" 
                             style="width: 100px; height: auto;">
                    </td>
                    <td><?php echo $detail['order_details_amount']; ?></td>
                    <td><?php echo number_format($detail['order_detail_price'], 0, ',', '.'); ?>$</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Tổng tiền</strong></td>
                    <td><strong><?php echo number_format($total, 0, ',', '.'); ?>$</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="order-actions mt-4">
        <?php if($order['order_status'] == 'Pending'): ?>
            <button class="btn btn-success" onclick="updateOrderStatus(<?php echo $order_id; ?>, 'confirm')">
                <i class="fas fa-check"></i> Xác nhận đơn hàng
            </button>
        <?php endif; ?>

        <?php if($order['order_status'] == 'Processing'): ?>
            <button class="btn btn-info" onclick="updateOrderStatus(<?php echo $order_id; ?>, 'ship')">
                <i class="fas fa-truck"></i> Giao hàng
            </button>
        <?php endif; ?>

        <?php if($order['order_status'] == 'Shipping'): ?>
            <button class="btn btn-success" onclick="updateOrderStatus(<?php echo $order_id; ?>, 'complete')">
                <i class="fas fa-check-circle"></i> Xác nhận đã giao
            </button>
        <?php endif; ?>

        <?php if($order['order_status'] != 'Completed' && $order['order_status'] != 'Cancelled'): ?>
            <button class="btn btn-danger" onclick="updateOrderStatus(<?php echo $order_id; ?>, 'cancel')">
                <i class="fas fa-times"></i> Hủy đơn hàng
            </button>
        <?php endif; ?>
    </div>

    <?php else: ?>
    <div class="alert alert-warning mt-4">
        Không tìm thấy thông tin đơn hàng.
    </div>
    <?php endif; ?>
</div>

<script>
function updateOrderStatus(orderId, action) {
    let messages = {
        'confirm': 'Bạn có chắc chắn muốn xác nhận đơn hàng này?',
        'ship': 'Bạn có chắc chắn muốn chuyển đơn hàng sang trạng thái giao hàng?',
        'complete': 'Xác nhận đã giao hàng thành công?',
        'cancel': 'Bạn có chắc chắn muốn hủy đơn hàng này?'
    };
    
    if(confirm(messages[action])) {
        window.location.href = `?page_layout=order_detail&order_id=${orderId}&action=${action}`;
    }
}
</script>

<style>
.order-info {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 5px;
}

.customer-details p {
    margin-bottom: 10px;
}

.order-details {
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.order-actions {
    display: flex;
    gap: 10px;
}

.table img {
    border-radius: 5px;
    object-fit: cover;
}

.status-badge {
    padding: 5px 10px;
    border-radius: 15px;
    font-weight: 500;
}

.status-badge.pending {
    background-color: #ffeeba;
    color: #856404;
}

.status-badge.processing {
    background-color: #b8daff;
    color: #004085;
}

.status-badge.shipping {
    background-color: #c3e6cb;
    color: #155724;
}

.status-badge.completed {
    background-color: #d4edda;
    color: #155724;
}

.status-badge.cancelled {
    background-color: #f8d7da;
    color: #721c24;
}
</style> 