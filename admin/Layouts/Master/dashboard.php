<?php
// Lấy số lượng sản phẩm
$sql_product_count = "SELECT COUNT(*) as total FROM products";
$result_products = mysqli_query($connect, $sql_product_count);
$product_count = mysqli_fetch_assoc($result_products)['total'];

// Lấy số lượng thành viên
$sql_user_count = "SELECT COUNT(*) as total FROM users";
$result_users = mysqli_query($connect, $sql_user_count);
$user_count = mysqli_fetch_assoc($result_users)['total'];

// Lấy số lượng đơn hàng
$sql_order_count = "SELECT COUNT(*) as total FROM orders";
$result_orders = mysqli_query($connect, $sql_order_count);
$order_count = mysqli_fetch_assoc($result_orders)['total'];

// Lấy số lượng đơn hàng đã thành công
$sql_completed_orders = "SELECT COUNT(*) as total FROM orders WHERE order_status = 'Completed'";
$result_completed = mysqli_query($connect, $sql_completed_orders);
$completed_count = mysqli_fetch_assoc($result_completed)['total'];
?>
<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Dashboard</h2>
        <input type="text" class="form-control w-25" placeholder="Search">
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                <i class="fa-solid fa-user"></i>
<!--                Admin-->
                <?= $_SESSION['username'] ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                <li><a class="dropdown-item" href="Layouts/Master/logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-3 col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-box fa-2x text-primary"></i>
                    <h3><?php echo $product_count; ?></h3>
                    <p>Sản phẩm</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-users fa-2x text-danger"></i>
                    <h3><?php echo $user_count; ?></h3>
                    <p>Thành viên</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa-solid fa-bag-shopping fa-2x text-warning"></i>
                    <h3><?php echo $order_count; ?></h3>
                    <p>Tổng đơn hàng</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fa-solid fa-check-circle fa-2x text-success"></i>
                    <h3><?php echo $completed_count; ?></h3>
                    <p>Đơn hàng đã giao</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm biểu đồ thống kê trạng thái đơn hàng -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thống kê trạng thái đơn hàng</h5>
                    <?php
                    // Lấy ra thống kê về mức độ hoàn thành của sản phẩm
                    $sql_status = "SELECT order_status, COUNT(*) as count 
                                 FROM orders 
                                 GROUP BY order_status";
                    $result_status = mysqli_query($connect, $sql_status);
                    
                    $status_colors = [
                        'Pending' => 'warning',
                        'Processing' => 'primary',
                        'Shipping' => 'info',
                        'Completed' => 'success',
                        'Cancelled' => 'danger'
                    ];

                    $status_names = [
                        'Pending' => 'Chờ xác nhận',
                        'Processing' => 'Đã xác nhận',
                        'Shipping' => 'Đang giao hàng',
                        'Completed' => 'Đã giao hàng',
                        'Cancelled' => 'Đã hủy'
                    ];

                    while($status = mysqli_fetch_assoc($result_status)) {
                        $percentage = ($order_count > 0) ? ($status['count'] / $order_count) * 100 : 0;
                        $status_name = isset($status_names[$status['order_status']]) ? 
                                     $status_names[$status['order_status']] : 
                                     $status['order_status'];
                        $color = isset($status_colors[$status['order_status']]) ? 
                                $status_colors[$status['order_status']] : 
                                'secondary';
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span><?php echo $status_name; ?></span>
                            <span><?php echo $status['count']; ?> đơn</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-<?php echo $color; ?>" 
                                 role="progressbar" 
                                 style="width: <?php echo $percentage; ?>%" 
                                 aria-valuenow="<?php echo $percentage; ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                <?php echo round($percentage, 1); ?>%
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
    margin-bottom: 20px;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.progress {
    height: 20px;
    border-radius: 10px;
}

.progress-bar {
    line-height: 20px;
    font-size: 12px;
}
</style>