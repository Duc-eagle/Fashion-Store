<?php
// Xử lý thêm danh mục
if(isset($_POST['submit'])) {
    $cate_name = $_POST['categoryName'];
    $description = $_POST['categoryDescription'];
    
    // Kiểm tra xem danh mục đã tồn tại chưa
    $check_sql = "SELECT * FROM categories WHERE cate_name = '$cate_name'";
    $check_query = mysqli_query($connect, $check_sql);
    
    if(mysqli_num_rows($check_query) > 0) {
        $error = "Danh mục này đã tồn tại!";
    } else {
        // Thêm danh mục mới
        $sql = "INSERT INTO categories (cate_name, Description, CreatedAt) VALUES ('$cate_name', '$description', NOW())";
        if(mysqli_query($connect, $sql)) {
            header('location: index.php?page_layout=category');
        } else {
            $error = "Có lỗi xảy ra: " . mysqli_error($connect);
        }
    }
}
?>

<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Thêm danh mục</h2>
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
        <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="categoryName" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Nhập tên danh mục" required>
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="form-label">Mô tả danh mục</label>
                <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" placeholder="Nhập mô tả danh mục"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-success">
                <i class="fas fa-plus"></i> Thêm mới
            </button>
            <a href="?page_layout=category" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


