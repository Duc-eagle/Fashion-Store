<?php
include_once('Config/connect.php');

// Lấy danh sách đơn hàng từ database
$sql = "SELECT o.*, c.fullname, c.cus_phone, c.cus_address 
        FROM orders o
        LEFT JOIN customers c ON o.customer_id = c.cus_id
        ORDER BY o.order_date DESC";
$query = mysqli_query($connect, $sql);
?>

<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Quản lý đơn hàng</h2>
        <input type="text" class="form-control w-25" placeholder="Tìm kiếm đơn hàng">
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
    <div class="middle table-container mt-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Ngày đặt</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(mysqli_num_rows($query) > 0) {
                while($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['order_date'])); ?></td>
                        <td><?php echo $row['fullname']; ?></td>
                        <td><?php echo $row['cus_phone']; ?></td>
                        <td><?php echo $row['cus_address']; ?></td>
                        <td><?php echo number_format($row['order_total_price'], 0, ',', '.'); ?>$</td>
                        <td>
                            <?php
                            $status_class = '';
                            $status_text = $row['order_status'];
                            switch($row['order_status']) {
                                case 'Pending':
                                    $status_class = 'text-warning';
                                    $status_text = 'Chờ xử lý';
                                    break;
                                case 'Processing':
                                    $status_class = 'text-primary';
                                    $status_text = 'Đang xử lý';
                                    break;
                                case 'Shipping':
                                    $status_class = 'text-info';
                                    $status_text = 'Đang giao hàng';
                                    break;
                                case 'Completed':
                                    $status_class = 'text-success';
                                    $status_text = 'Hoàn thành';
                                    break;
                                case 'Cancelled':
                                    $status_class = 'text-danger';
                                    $status_text = 'Đã hủy';
                                    break;
                            }
                            ?>
                            <span class="<?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                        </td>
                        <td>
                            <a href="?page_layout=order_detail&order_id=<?php echo $row['order_id']; ?>" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                            <a href="?page_layout=order_update&order_id=<?php echo $row['order_id']; ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Cập nhật
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="8" class="text-center">Không có đơn hàng nào.</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>