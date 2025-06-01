<?php
$sql_prd = "SELECT * FROM products ORDER BY product_id DESC LIMIT 4";
$query_prd = mysqli_query($connect , $sql_prd);
?>
<header>
    <?php include_once ('header.php')?>
</header>
<main>
    <!--Home-->
    <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Welcome to</span> your local drip store</h1>
            <p>Based in HaNoi</p>
            <button>Shop Now</button>
        </div>
    </section>



    <!--New-->
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <!--        One-->
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0">
                <img src="assets/imgs/drip7.png" alt="" class="img-fluid">
                <div class="details">
                    <h2>Costume</h2>
                    <button class="text-uppercase" onclick="window.location.href='index.php?pageLayout=shopcostume'">Mua Ngay</button>
                </div>
            </div>
            <!--        Two-->
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0">
                <img src="assets/imgs/drip3.png" alt="" class="img-fluid">
                <div class="details">
                    <h2>Giày</h2>
                    <button class="text-uppercase" onclick="window.location.href='index.php?pageLayout=shopshoes'">Mua Ngay</button>
                </div>
            </div>
            <!--        Three-->
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0">
                <img src="assets/imgs/drip4.png" alt="" class="img-fluid">
                <div class="details">
                    <h2>Jacket</h2>
                    <button class="text-uppercase" onclick="window.location.href='index.php?pageLayout=shopjacket'">Mua Ngay</button>
                </div>
            </div>
            <!--        Four-->
            <div class="one col-lg-3 col-md-12 col-sm-12 p-0">
                <img src="assets/imgs/drip5.png" alt="" class="img-fluid">
                <div class="details">
                    <h2>Jeans</h2>
                    <button class="text-uppercase" onclick="window.location.href='index.php?pageLayout=shopjeans'">Mua Ngay</button>
                </div>
            </div>
        </div>
    </section>

    <!--Featured-->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Sản phẩm nổi bật</h3>
            <hr class="mx-auto">
            <p>Khám phá các sản phẩm nội bật của DRIPKING</p>
        </div>

        <div class="row mx-auto container-fluid">
            <?php
            while ($item = mysqli_fetch_array($query_prd)) {
            ?>
            <a class="col-lg-3 col-md-4 col-sm-12" href="?pageLayout=singleProduct&product_id=<?= $item['product_id'] ?>" style="text-decoration: none; color: inherit;">
                <div class="product text-center">
                    <img src="admin/images/<?= $item['product_image1'] ?>" alt="" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h5 class="p-name"><?= $item['product_name'] ?></h5>
                    <h4 class="p-price">$<?= $item['product_price'] ?></h4>
                    <button class="buy-btn">Mua Ngay</button>
                </div>
            </a>
            <?php
            }
            ?>

        </div>
    </section>

    <!--Banner-->
    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>MID SEASON'S SALE</h4>
            <h1>Bộ sưu tập 2025 <br> 20% SALE OFF</h1>
            <button class="text-uppercase">Mua Ngay</button>
        </div>
    </section>

    <!--Clothes-->
</main>
<footer>
    <?php include_once ('footer.php')?>
</footer>

