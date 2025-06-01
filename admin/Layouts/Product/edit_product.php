<?php
//Lấy danh mục
$sql_cate = "SELECT * FROM categories ORDER BY cate_id ASC";
$query_cate = mysqli_query($connect , $sql_cate);

//Truy vấn tìm bản ghi sản phẩm theo id truyền sang
$product_id = $_GET['product_id'];
$sql_prd = "SELECT * FROM products WHERE `product_id` = $product_id";
$row = mysqli_fetch_array(mysqli_query($connect , $sql_prd));

//Thêm sản phẩm
if (isset($_POST['sbm'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_category = $_POST['product_category'];
    $product_size = $_POST['product_size'];
    $product_description = $_POST['product_description'];
    //Trong trường hợp người dùng không thay đổi ảnh sản phẩm
    if ($_FILES['product_image1'] == '') {
        $product_image1 = $row['product_image1'];
    } else {
        //Lấy ra tên tệp
        $product_image1 = $_FILES['product_image1']['name'];
        //Lưu trữ tạm thời tệp vừa upload
        $tmp = $_FILES['product_image1']['tmp_name'];
        //Lấy ảnh từ thư mục tạm về thư mục của dự án
        move_uploaded_file($tmp , 'images/' . $product_image1);
    }
    //Truy vấn bản ghi
    $sql = "UPDATE products SET `product_name` = '$product_name' , `product_price` = $product_price , `product_quantity` = $product_quantity , `product_category` = '$product_category' , `product_size` = '$product_size' , `product_description` = '$product_description' , `product_image1` = '$product_image1'
            WHERE `product_id` = $product_id ";
    mysqli_query($connect , $sql);
    //Chuyển hướng về trang danh sách
    header('location: ?page_layout=product');
    exit;
}
?>






<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Sửa sản phẩm: <?= $row['product_name'] ?> </h2>
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
                <input type="text" name="product_name" class="form-control" id="productName" placeholder="Nhập tên sản phẩm" required value="<?= $row['product_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá sản phẩm</label>
                <input type="number" name="product_price" class="form-control" id="productPrice" placeholder="Nhập giá sản phẩm" required value="<?= $row['product_price'] ?>">
            </div>
            <div class="mb-3">
                <label for="productQuantity" class="form-label">Số lượng</label>
                <input type="number" name="product_quantity" class="form-control" id="productQuantity" placeholder="Nhập số lượng" required value="<?= $row['product_quantity'] ?>">
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh mục</label>
                <select class="form-control" name="product_category" id="productCategory" required>
                    <?php
                    while ($item = mysqli_fetch_array($query_cate)) {
                        ?>
                        <option <?php if ($item['cate_id'] == $row['category_id']){echo 'selected';} ?> value=<?= $item['cate_id'] ?>><?= $item['cate_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="productSize" class="form-label">Kích thước</label>
                <select name="product_size" id="productSize" class="form-control">
                    <option <?php if ($row['product_size'] == 'S'){echo 'selected';} ?> value="S">S</option>
                    <option <?php if ($row['product_size'] == 'M'){echo 'selected';} ?> value="M">M</option>
                    <option <?php if ($row['product_size'] == 'L'){echo 'selected';} ?> value="L">L</option>
                    <option <?php if ($row['product_size'] == 'XL'){echo 'selected';} ?> value="XL">XL</option>
                    <option <?php if ($row['product_size'] == 'XXL'){echo 'selected';} ?> value="XXL">XXL</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Ảnh sản phẩm</label>
                <input type="file" name="product_image1" class="form-control" id="productImage">
                <div>
                    <img id="currentImage" src="images/<?= $row['product_image1'] ?>" alt="">
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

            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" name="product_description" id="productDescription" rows="3" placeholder="Nhập mô tả"><?= $row['product_description'] ?></textarea>
            </div>
            <button name="sbm" type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cập nhật</button>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-sync"></i> Làm mới</button>
        </form>
        <div/>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


