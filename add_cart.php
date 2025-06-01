<?php
session_start();

// Kiểm tra product_id có tồn tại và hợp lệ
if(!isset($_GET['product_id']) || !is_numeric($_GET['product_id'])) {
    header('location: index.php');
    exit();
}

$product_id = $_GET['product_id'];

// Khởi tạo giỏ hàng nếu chưa tồn tại
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Lấy số lượng từ session hoặc mặc định là 1
$quantity = isset($_SESSION['quantity']) ? $_SESSION['quantity'] : 1;

// Kiểm tra xem sản phẩm đó đã có trong giỏ hàng hay chưa
if (isset($_SESSION['cart'][$product_id])) {
    // Cập nhật số lượng mới thay vì cộng dồn
    $_SESSION['cart'][$product_id]['quantity'] = $quantity;
} else {
    $_SESSION['cart'][$product_id] = array(
        'quantity' => $quantity
    );
}

// Reset session quantity sau khi đã thêm vào giỏ hàng
unset($_SESSION['quantity']);

// Chuyển hướng đến giao diện hiển thị giỏ hàng
header('location: index.php?pageLayout=cart');
exit();
?>

