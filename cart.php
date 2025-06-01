<?php


// Lấy thông tin customer nếu đã đăng nhập
$customer_info = null;
if (isset($_SESSION['user_id'])) {
    $cus_id = $_SESSION['user_id'];
    $sql_customer = "SELECT * FROM customers WHERE cus_id = $cus_id";
    $query_customer = mysqli_query($connect, $sql_customer);
    $customer_info = mysqli_fetch_assoc($query_customer);
}

// Cập nhật số lượng giỏ hàng
if(isset($_POST['update_cart'])) {
    $updated = false;
    foreach($_POST['quantity'] as $product_id => $quantity) {
        if($quantity > 0) {
            if(!isset($_SESSION['cart'][$product_id]['quantity']) || 
               $_SESSION['cart'][$product_id]['quantity'] != $quantity) {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;
                $updated = true;
            }
        }
    }
    if($updated) {
        $_SESSION['cart_message'] = '<div class="alert alert-success">Cập nhật giỏ hàng thành công!</div>';
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}
?>
<header>
    <?php include_once ('header.php'); ?>
</header>
<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Tạo mảng lưu trữ id của sản phẩm trong session giỏ hàng
    $cart = array();
    foreach ($_SESSION['cart'] as $key => $value) {
        if(isset($value['quantity']) && $value['quantity'] > 0) {
            $cart[] = $key;
        }
    }
    
    // Kiểm tra nếu giỏ hàng có sản phẩm
    if(!empty($cart)) {
        $str_cart = implode(', ', $cart);
        $s_show_cart = "SELECT * FROM products WHERE product_id IN($str_cart)";
        $q_show_cart = mysqli_query($connect, $s_show_cart);
        
        if($q_show_cart && mysqli_num_rows($q_show_cart) > 0) {
?>

<!--Cart-->
<section class="row mx-auto cart container-fluid my-5 py-5">
    <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="container text-center mt-5">
            <h2 class="font-weight-bolder">Giỏ hàng của bạn</h2>
            <hr class="mx-auto">
            <?php 
            // Hiển thị thông báo lỗi nếu có
            if(isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            // Hiển thị thông báo thành công nếu có
            if(isset($_SESSION['cart_message'])) {
                echo $_SESSION['cart_message'];
                unset($_SESSION['cart_message']);
            }
            ?>
        </div>
        <form method="post" action="">
            <table class="mt-5 pt-5">
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Tác vụ</th>
                </tr>
                <?php
                $stt = 1;
                $total = 0;
                while ($item = mysqli_fetch_array($q_show_cart)) {
                    $product_id = $item['product_id'];
                    $quantity = isset($_SESSION['cart'][$product_id]['quantity']) ? $_SESSION['cart'][$product_id]['quantity'] : 1;
                    $subtotal = $item['product_price'] * $quantity;
                    $total += $subtotal;
                ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <?= $stt ?>
                        </div>
                    </td>

                    <td>
                        <div class="product-info">
                            <?= $item['product_name'] ?>
                        </div>
                    </td>

                    <td>
                        <div class="product-info">
                            <img src="admin/images/<?= $item['product_image1'] ?>" alt="">
                        </div>
                    </td>

                    <td>
                        <div class="product-info">
                            <input type="number" 
                                   name="quantity[<?= $product_id ?>]" 
                                   value="<?= $quantity ?>" 
                                   min="1" 
                                   max="<?= $item['product_quantity'] ?>"
                                   onchange="document.querySelector('[name=update_cart]').click();">
                        </div>
                    </td>

                    <td>
                        <div class="product-info">
                            <small><span>$</span><?= number_format($item['product_price']) ?></small>
                        </div>
                    </td>

                    <td>
                        <div class="product-info">
                            <small><span>$</span><?= number_format($subtotal) ?></small>
                        </div>
                    </td>

                    <td>
                        <div class="product-info">
                            <a href="delete_cart.php?product_id=<?= $product_id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
                    $stt++;
                }
                ?>
            </table>
            <div class="container row mt-4">
                <div class="col-lg-6 col-md-6 col-lg-6">
                    Tổng tiền: <span>$<?= number_format($total) ?></span>
                </div>
                <div class="col-lg-6 col-md-6 col-lg-6 text-end">
                    <button type="submit" name="update_cart" >Cập nhật giỏ hàng</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (isset($_SESSION['username'])) {
    ?>
    <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="container text-center mt-5">
            <h2 class="font-weight-bolder">Thông tin mua hàng</h2>
            <hr class="mx-auto">
        </div>
        <form action="process_order.php" method="post">
            <div class="cartInfo">
                <label for="fullname">Họ và tên</label>
                <br>
                <input type="text" name="fullname" id="fullname" value="<?= isset($customer_info['fullname']) ? $customer_info['fullname'] : '' ?>" required>
            </div>
            <div class="cartInfo">
                <label for="phone">Số điện thoại</label>
                <br>
                <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" value="<?= isset($customer_info['cus_phone']) ? $customer_info['cus_phone'] : '' ?>" required>
            </div>
            <div class="cartInfo">
                <label for="address">Địa chỉ mua hàng</label>
                <br>
                <input type="text" name="address" id="address" value="<?= isset($customer_info['cus_address']) ? $customer_info['cus_address'] : '' ?>" required>
            </div>
            <input type="hidden" name="total_amount" value="<?= $total ?>">
            <button class="mt-2" type="submit" name="place_order">Mua hàng</button>
        </form>
    </div>
    <?php
    } else {
    ?>
    <div style="margin-top: 50px" class="col-lg-4 col-md-12 col-sm-12 text-center">
        <div class="alert-danger alert">Vui lòng đăng nhập để mua hàng</div>
        <a href="?pageLayout=login" class="btn btn-info">Đăng nhập</a>
        <a href="?pageLayout=register" class="btn btn-primary">Đăng ký</a>
    </div>
    <?php
    }
    ?>
</section>
<?php
        } else {
            // Không tìm thấy sản phẩm nào trong database
            show_empty_cart();
        }
    } else {
        // Giỏ hàng trống
        show_empty_cart();
    }
} else {
    // Session cart không tồn tại hoặc trống
    show_empty_cart();
}

function show_empty_cart() {
?>
    <section>
        <div class="container">
            <div style="margin-top: 200px" class="alert alert-danger text-center">
                Bạn chưa có sản phẩm nào trong giỏ hàng, vui lòng thêm sản phẩm để trải nghiệm mua sắm
            </div>
        </div>
    </section>
<?php
}
?>
<footer>
    <?php include_once('footer.php'); ?>
</footer>
