<?php
session_start();

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Xóa sản phẩm khỏi giỏ hàng
    if(isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    
    // Chuyển hướng về trang giỏ hàng
    header('location: index.php?pageLayout=cart');
    exit();
} else {
    header('location: index.php');
    exit();
}
?>
