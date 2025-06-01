<?php
//$product_id = $_GET['product_id'];
//$sql = 'SELECT * FROM products WHERE product_id = '.$product_id.'';
//$query = mysqli_query($connect , $sql);
//while($val = mysqli_fetch_array($query)) {
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $query = mysqli_query($connect, $sql);
    $product = mysqli_fetch_assoc($query);
} else {
    echo "Không tìm thấy sản phẩm.";
    exit;
}
?>
<header>
    <?php include_once ('header.php')?>
</header>


<!--Single Product-->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" id="mainImg" src="admin/images/<?= $product['product_image1'] ?>" alt="">
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <?php
            if (isset($_POST['buy'])) {
                $_SESSION['quantity'] = $_POST['quantity'];
                header('location: add_cart.php?product_id='.$product['product_id']);
                exit();
            }
            ?>
            <form action="" method="post">
                <h4><?= $product['product_name'] ?></h4>
<!--                <h3 class="py-4">--><?//= $product['product_category'] ?><!--</h3>-->
                <h2>$<?= $product['product_price'] ?></h2>
                <input type="number" value="1" id="quantity" name="quantity" min="1" max="<?= $product['product_quantity'] ?>">
                <button type="submit" class="buy-btn" name="buy">Thêm vào giỏ hàng</button>
                <h4 class="mt-5 mb-5">Chi tiết sản phẩm</h4>
                <span><?= $product['product_description'] ?></span>
            </form>

        </div>

    </div>
</section>

<!--Related Product-->
<section id="related-product" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Sản phầm tương tự</h3>
        <hr class="mx-auto">
    </div>

    <div class="row mx-auto container-fluid">
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/drip7.png" alt="" class="img-fluid mb-3">
            <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name">NK SYNA</h5>
            <h4 class="p-price">$400</h4>
            <button class="buy-btn">Mua Ngay</button>
        </div>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/drip8.png" alt="" class="img-fluid mb-3">
            <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name">Bape Star</h5>
            <h4 class="p-price">$400</h4>
            <button class="buy-btn">Mua Ngay</button>
        </div>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/drip9.png" alt="" class="img-fluid mb-3">
            <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name">Puffer Trap</h5>
            <h4 class="p-price">$400</h4>
            <button class="buy-btn">Mua Ngay</button>
        </div>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/drip10.png" alt="" class="img-fluid mb-3">
            <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <h5 class="p-name">Rockstar Jeans</h5>
            <h4 class="p-price">$400</h4>
            <button class="buy-btn">Mua Ngay</button>
        </div>
    </div>
</section>

<footer>
    <?php include_once ('footer.php')?>
</footer>
