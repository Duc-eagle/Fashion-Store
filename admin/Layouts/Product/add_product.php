<?php
//Lấy danh mục
$sql_cate = "SELECT * FROM categories ORDER BY cate_id ASC";
$query_cate = mysqli_query($connect , $sql_cate);


//Thêm sản phẩm
if (isset($_POST['sbm'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_category = $_POST['product_category'];
    $product_size = $_POST['product_size'];
    $product_description = $_POST['product_description'];
    //Lấy ra tên tệp
    $product_image1 = $_FILES['product_image1']['name'];
    //Lưu trữ tạm thời tệp vừa upload
    $tmp = $_FILES['product_image1']['tmp_name'];
    //Truy vấn bản ghi
    $sql = "INSERT INTO products (`product_name` , `product_price` , `product_quantity` , `product_category` , `product_size` , `product_description` , `product_image1`)
            VALUES (
                    '$product_name' , $product_price , $product_quantity , '$product_category' ,'$product_size' , '$product_description' , '$product_image1'
            )";
    mysqli_query($connect , $sql);
    //Lấy ảnh từ thư mục tạm về thư mục của dự án
    move_uploaded_file($tmp , 'images/' . $product_image1);
    //Chuyển hướng về trang danh sách
    header('location: ?page_layout=product');
    exit;
}
?>






<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Thêm sản phẩm</h2>
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
        <form role="form" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Tên sản phẩm</label>
                <input type="text" name="product_name" class="form-control" id="productName" placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá sản phẩm</label>
                <input type="number" name="product_price" class="form-control" id="productPrice" placeholder="Nhập giá sản phẩm" required>
            </div>
            <div class="mb-3">
                <label for="productQuantity" class="form-label">Số lượng</label>
                <input type="number" name="product_quantity" class="form-control" id="productQuantity" placeholder="Nhập số lượng" required>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh mục</label>
                <select class="form-control" name="product_category" id="productCategory" required>
                    <?php
                    while ($item = mysqli_fetch_array($query_cate)) {
                    ?>
                    <option value=<?= $item['cate_id'] ?>><?= $item['cate_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="productSize" class="form-label">Kích thước</label>
                <select name="product_size" id="productSize" class="form-control">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Ảnh sản phẩm</label>
                <input type="file" name="product_image1" class="form-control" id="productImage" required>
                <div id="preview" class="mt-3"></div>
                <script>
                    document.getElementById('productImage').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const preview = document.getElementById('preview');
                                preview.innerHTML = `<img src="${e.target.result}" class="img-fluid" style="width: 50px;height: 50px" lt="Product Image">`;
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>

            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" name="product_description" id="productDescription" rows="3" placeholder="Nhập mô tả"></textarea>
            </div>
            <button name="sbm" type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Thêm mới</button>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-sync"></i> Làm mới</button>
        </form>
    <div/>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

