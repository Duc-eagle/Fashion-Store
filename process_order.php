<?php
session_start();
include_once('admin/Config/connect.php');

// Thêm debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kiểm tra session và POST data
if(!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Vui lòng đăng nhập để mua hàng";
    header("Location: index.php?pageLayout=cart");
    exit();
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['error'] = "Giỏ hàng của bạn đang trống";
    header("Location: index.php?pageLayout=cart");
    exit();
}

if(!isset($_POST['place_order'])) {
    $_SESSION['error'] = "Yêu cầu không hợp lệ";
    header("Location: index.php?pageLayout=cart");
    exit();
}

// Lấy và validate dữ liệu
$customer_id = $_SESSION['user_id'];
$fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
$phone = mysqli_real_escape_string($connect, $_POST['phone']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$total_amount = $_POST['total_amount'];
$order_date = date('Y-m-d H:i:s');

// Validate dữ liệu
if(empty($fullname) || empty($phone) || empty($address)) {
    $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin";
    header("Location: index.php?pageLayout=cart");
    exit();
}

if(!preg_match("/^[0-9]{10}$/", $phone)) {
    $_SESSION['error'] = "Số điện thoại không hợp lệ";
    header("Location: index.php?pageLayout=cart");
    exit();
}

// Bắt đầu transaction
mysqli_begin_transaction($connect);

try {
    // Tạo user mới nếu chưa có
    $sql_check_user = "SELECT user_id FROM users WHERE user_name = ?";
    $stmt_check = mysqli_prepare($connect, $sql_check_user);
    mysqli_stmt_bind_param($stmt_check, "s", $fullname);
    mysqli_stmt_execute($stmt_check);
    $result = mysqli_stmt_get_result($stmt_check);
    
    if(mysqli_num_rows($result) == 0) {
        // Tạo user mới
        $sql_new_user = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
        $stmt_new_user = mysqli_prepare($connect, $sql_new_user);
        $default_password = password_hash("123456", PASSWORD_DEFAULT); // Mật khẩu mặc định
        $email = "user" . time() . "@example.com"; // Email tạm thời
        mysqli_stmt_bind_param($stmt_new_user, "sss", $fullname, $email, $default_password);
        mysqli_stmt_execute($stmt_new_user);
        $user_id = mysqli_insert_id($connect);
    } else {
        $user_data = mysqli_fetch_assoc($result);
        $user_id = $user_data['user_id'];
    }

    // Tạo đơn hàng mới với cả user_id và customer_id
    $sql_order = "INSERT INTO orders (order_total_price, order_status, user_id, customer_id, order_date) 
                 VALUES (?, 'Pending', ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql_order);
    mysqli_stmt_bind_param($stmt, "diis", $total_amount, $user_id, $customer_id, $order_date);
    
    if(!mysqli_stmt_execute($stmt)) {
        throw new Exception("Lỗi khi tạo đơn hàng: " . mysqli_stmt_error($stmt));
    }
    
    // Lấy order_id vừa tạo
    $order_id = mysqli_insert_id($connect);
    
    // Thêm chi tiết đơn hàng
    foreach($_SESSION['cart'] as $product_id => $item) {
        // Lấy thông tin sản phẩm
        $sql_product = "SELECT product_price, product_quantity FROM products WHERE product_id = ?";
        $stmt_product = mysqli_prepare($connect, $sql_product);
        mysqli_stmt_bind_param($stmt_product, "i", $product_id);
        mysqli_stmt_execute($stmt_product);
        $result = mysqli_stmt_get_result($stmt_product);
        $product = mysqli_fetch_assoc($result);
        
        if(!$product) {
            throw new Exception("Không tìm thấy sản phẩm với ID: " . $product_id);
        }
        
        $quantity = $item['quantity'];
        $price = $product['product_price'];
        
        // Kiểm tra số lượng tồn kho
        if($product['product_quantity'] < $quantity) {
            throw new Exception("Sản phẩm không đủ số lượng trong kho");
        }
        
        // Thêm vào order_details
        $sql_detail = "INSERT INTO order_details (order_id, product_id, order_detail_price, order_details_amount) 
                      VALUES (?, ?, ?, ?)";
        $stmt_detail = mysqli_prepare($connect, $sql_detail);
        mysqli_stmt_bind_param($stmt_detail, "iidi", $order_id, $product_id, $price, $quantity);
        
        if(!mysqli_stmt_execute($stmt_detail)) {
            throw new Exception("Lỗi khi thêm chi tiết đơn hàng: " . mysqli_stmt_error($stmt_detail));
        }
        
        // Cập nhật số lượng sản phẩm
        $new_quantity = $product['product_quantity'] - $quantity;
        $sql_update = "UPDATE products SET product_quantity = ? WHERE product_id = ?";
        $stmt_update = mysqli_prepare($connect, $sql_update);
        mysqli_stmt_bind_param($stmt_update, "ii", $new_quantity, $product_id);
        
        if(!mysqli_stmt_execute($stmt_update)) {
            throw new Exception("Lỗi khi cập nhật số lượng sản phẩm: " . mysqli_stmt_error($stmt_update));
        }
    }
    
    // Cập nhật thông tin khách hàng
    $sql_customer = "UPDATE customers SET fullname = ?, cus_phone = ?, cus_address = ? WHERE cus_id = ?";
    $stmt_customer = mysqli_prepare($connect, $sql_customer);
    mysqli_stmt_bind_param($stmt_customer, "sssi", $fullname, $phone, $address, $customer_id);
    
    if(!mysqli_stmt_execute($stmt_customer)) {
        throw new Exception("Lỗi khi cập nhật thông tin khách hàng: " . mysqli_stmt_error($stmt_customer));
    }
    
    // Commit transaction
    mysqli_commit($connect);
    
    // Xóa giỏ hàng
    unset($_SESSION['cart']);
    
    // Chuyển hướng đến trang thành công
    $_SESSION['success'] = "Đặt hàng thành công!";
    header("Location: index.php?pageLayout=success");
    exit();
    
} catch (Exception $e) {
    // Rollback nếu có lỗi
    mysqli_rollback($connect);
    
    $_SESSION['error'] = $e->getMessage();
    header("Location: index.php?pageLayout=cart");
    exit();
} 