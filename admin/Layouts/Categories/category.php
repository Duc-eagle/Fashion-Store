<?php
// Lấy danh sách danh mục từ CSDL
$sql = "SELECT c.*, COUNT(p.product_id) as product_count 
        FROM categories c 
        LEFT JOIN products p ON c.cate_id = p.product_category 
        GROUP BY c.cate_id";
$query = mysqli_query($connect, $sql);
?>

<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Quản lý danh mục</h2>
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
        <button class="btn btn-primary my-3">
            <i class="fas fa-plus"></i>
            <a class="text-white text-decoration-none" href="?page_layout=addCategory">Thêm danh mục</a>
        </button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Số sản phẩm</th>
                <th>Ngày tạo</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(mysqli_num_rows($query) > 0) {
                while($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?php echo $row['cate_id']; ?></td>
                    <td><?php echo $row['cate_name']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['product_count']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['CreatedAt'])); ?></td>
                    <td>
                        <a href="?page_layout=editCategory&id=<?php echo $row['cate_id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="?page_layout=deleteCategory&id=<?php echo $row['cate_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="6" class="text-center">Không có danh mục nào</td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


