<?php
include_once('header.php');

// Số sản phẩm trên mỗi trang
$items_per_page = 12;

// Lấy trang hiện tại
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, $current_page); // Đảm bảo trang không nhỏ hơn 1

// Tính offset
$offset = ($current_page - 1) * $items_per_page;

// Lấy tổng số sản phẩm
$total_query = "SELECT COUNT(*) as total FROM products";
$total_result = mysqli_query($connect, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_items = $total_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_items / $items_per_page);
$current_page = min($current_page, $total_pages); // Đảm bảo trang không vượt quá tổng số trang

// Lấy sản phẩm cho trang hiện tại
$sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT $offset, $items_per_page";
$query = mysqli_query($connect, $sql);
?>

<!--Featured-->
<section id="featured" class="my-5 py-5">
    <div class="container mt-5 py-5">
        <h3>Sản phẩm</h3>
        <hr>
        <p>Khám phá tất cả sản phẩm của DRIPKING</p>
    </div>

    <div class="row mx-auto container">
        <?php
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="admin/images/<?php echo $row['product_image1']; ?>" alt="" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
                    <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
                    <button class="buy-btn" onclick="window.location.href='index.php?pageLayout=singleProduct&product_id=<?php echo $row['product_id']; ?>'">Mua Ngay</button>
                </div>
            <?php
            }
        } else {
            echo '<div class="container"><p>Không có sản phẩm nào.</p></div>';
        }
        ?>

        <?php if ($total_pages > 1): ?>
        <nav aria-label="Page navigation" class="w-100">
            <ul class="pagination mt-5 justify-content-center">
                <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a href="?pageLayout=shop&page=<?php echo $current_page - 1; ?>" class="page-link">Previous</a>
                </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                    <a href="?pageLayout=shop&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                <li class="page-item">
                    <a href="?pageLayout=shop&page=<?php echo $current_page + 1; ?>" class="page-link">Next</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</section>

<?php
include_once('footer.php');
?>

