<?php
//Bảo mật trang con tránh việc truy cập trực tiếp qua URL
//Hàm defined() dùng đề kiểm tra sự tồn tại của 1 hằng trong php
if (!defined('SECURITY')) {
    die('Bạn đang truy cập trái phép,vui lòng đăng nhập để sử dụng');
}
//giải thuật phân trang
$row_per_page = 5; //Số lượng bản ghi hiển thị trong 1 trang

// Tính tổng số bản ghi
$sql_count = "SELECT COUNT(*) as total FROM products";
$query_count = mysqli_query($connect, $sql_count);
$row_count = mysqli_fetch_assoc($query_count);
$total_records = $row_count['total'];

// Tính tổng số trang
$total_pages = ceil($total_records / $row_per_page);

// Xác định trang hiện tại
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$current_page = max(1, min($current_page, $total_pages));

// Tính offset cho LIMIT trong SQL
$offset = ($current_page - 1) * $row_per_page;

//Hiển thị sản phẩm
$sql = "SELECT * FROM products p INNER JOIN categories c ON c.cate_id = p.product_category ORDER BY product_id DESC LIMIT $offset, $row_per_page";
$query = mysqli_query($connect, $sql);
?>



<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Quản lý sản phẩm</h2>
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
    <div class="middle table-container mt-5">
        <button class="btn btn-primary mb-3"><i class="fas fa-plus"></i><a class="<?php if (isset($_GET['page_layout']) && $_GET['page_layout'] == 'addProduct'){echo 'active';} ?>" href="?page_layout=addProduct">Thêm sản phẩm</a></button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Ảnh sản phẩm</th>
                <th>Trạng thái</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $stt = 1;
            while ($item = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?= $stt ?></td>
                <td><?= $item['product_name'] ?></td>
                <td><?= number_format($item['product_price']) ?></td>
                <td><img src="images/<?= $item['product_image1'] ?>" width="50"></td>
                <?php
                if ($item['product_quantity'] > 5) {
                ?>
                <td><span class="badge bg-success">Còn hàng</span></td>
                <?php
                } elseif ($item['product_quantity'] >= 1 && $item['product_quantity'] <= 5) {
                ?>
                <td><span class="badge bg-warning text-dark">Sắp hết hàng</span></td>
                <?php
                } else {
                ?>
                <td><span class="badge bg-danger">Hết hàng</span></td>
                <?php
                }
                ?>
                <td><?= $item['cate_name']  ?></td>
                <td>
                    <button class="btn btn-warning btn-sm"><a href="?page_layout=editProduct&product_id=<?= $item['product_id'] ?>"><i class="fas fa-edit"></i> Sửa</a></button>
                    <button class="btn btn-danger btn-sm"><a onclick="return confirm('Xác nhận xóa?')" href="?page_layout=deleteProduct&product_id=<?= $item['product_id'] ?>"><i class="fas fa-trash"></i> Xóa</a></button>
                </td>
            </tr>
            <?php
                $stt++;
            }
            ?>
            </tbody>
        </table>
    <div/>

        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($current_page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page_layout=product&page=<?= ($current_page - 1) ?>" tabindex="-1">Trước</a>
                </li>
                
                <?php
                for($i = 1; $i <= $total_pages; $i++) {
                    $active_class = ($i == $current_page) ? 'active' : '';
                ?>
                    <li class="page-item <?= $active_class ?>">
                        <a class="page-link" href="?page_layout=product&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php
                }
                ?>
                
                <li class="page-item <?php if($current_page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page_layout=product&page=<?= ($current_page + 1) ?>">Sau</a>
                </li>
            </ul>
        </nav>

    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
