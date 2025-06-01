<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem đã có kết nối database chưa
if (!isset($connect)) {
    require_once('connect.php');
}

if (isset($_POST['sbm'])) {
    $cus_username = mysqli_real_escape_string($connect, $_POST['cus_username']);
    $cus_pass = mysqli_real_escape_string($connect, $_POST['cus_pass']);
    $re_cus_pass = mysqli_real_escape_string($connect, $_POST['re_cus_pass']);
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $cus_phone = mysqli_real_escape_string($connect, $_POST['cus_phone']);
    $cus_address = mysqli_real_escape_string($connect, $_POST['cus_address']);

    // Kiểm tra username đã tồn tại chưa
    $check_username = mysqli_query($connect, "SELECT * FROM customers WHERE cus_username = '$cus_username'");
    if(mysqli_num_rows($check_username) > 0) {
        $error = '<div class="alert alert-danger">Tên tài khoản đã tồn tại!</div>';
    }
    else if ($cus_pass != $re_cus_pass) {
        $error = '<div class="alert alert-danger">Nhập lại mật khẩu không đúng!</div>';
    } 
    else {
        $hashed_password = password_hash($cus_pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO customers (cus_username, cus_pass, fullname, cus_phone, cus_address)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $cus_username, $hashed_password, $fullname, $cus_phone, $cus_address);
        
        if(mysqli_stmt_execute($stmt)) {
            $_SESSION['register_success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            header("Location: index.php?pageLayout=login");
            exit();
        } else {
            $error = '<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại!</div>';
        }
    }
}
?>

<header>
    <?php include_once('header.php'); ?>
</header>

<!--Register-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Đăng Ký Tài Khoản</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <?php if(isset($error)) echo $error; ?>
        <form action="index.php?pageLayout=register" method="POST" id="register-form">
            <div class="form-group">
                <label for="register-name">Tên Tài Khoản</label>
                <input type="text" class="form-control" id="register-name" name="cus_username" placeholder="Tên tài khoản" required>
            </div>
            <div class="form-group">
                <label for="register-password">Mật khẩu</label>
                <input type="password" class="form-control" id="register-password" name="cus_pass" placeholder="Mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="register-confirm-password">Nhập Lại Mật khẩu</label>
                <input type="password" class="form-control" id="register-confirm-password" name="re_cus_pass" placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="fullname">Họ và tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ và tên" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="tel" class="form-control" id="phone" name="cus_phone" placeholder="Số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="cus_address" placeholder="Địa chỉ" required>
            </div>
            <div class="form-group">
                <button type="submit" name="sbm" class="btn" id="register-btn">Đăng ký</button>
            </div>
            <div class="form-group">
                <a href="index.php?pageLayout=login" id="login-url" class="btn">Bạn đã có tài khoản? Đăng nhập tại đây!</a>
            </div>
        </form>
    </div>
</section>

<footer>
    <?php include_once('footer.php'); ?>
</footer>

