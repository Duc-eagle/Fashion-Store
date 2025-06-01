<?php
session_start();
ob_start();

// Kiểm tra xem đã có kết nối database chưa
if (!isset($connect)) {
    require_once('admin/Config/connect.php');
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Kiểm tra thông tin đăng nhập trong bảng customers
    $sql = "SELECT * FROM customers WHERE cus_username = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Kiểm tra mật khẩu
        if (password_verify($password, $user['cus_pass'])) {
            // Đăng nhập thành công
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['cus_id'];
            $_SESSION['fullname'] = $user['fullname'];
            
            // Chuyển hướng về trang chủ
            header("Location: index.php");
            exit();
        } else {
            $error = '<div class="alert alert-danger">Mật khẩu không đúng!</div>';
        }
    } else {
        $error = '<div class="alert alert-danger">Tài khoản không tồn tại!</div>';
    }
}
?>

<header>
    <?php include_once('header.php'); ?>
</header>

<!--Login-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Đăng Nhập</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <?php if(isset($error)) echo $error; ?>
        <?php if(isset($_SESSION['register_success'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['register_success'];
                    unset($_SESSION['register_success']);
                ?>
            </div>
        <?php endif; ?>
        
        <form action="" method="POST" id="login-form">
            <div class="form-group">
                <label for="login-email">Tên đăng nhập</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="login-password">Mật khẩu</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Mật khẩu" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" id="login-btn" name="login" value="Đăng nhập">
            </div>
            <div class="form-group">
                <a href="index.php?pageLayout=register" id="register-url" class="btn">Không có tài khoản? Đăng kí tại đây!</a>
            </div>
        </form>
    </div>
</section>

<footer>
    <?php include_once('footer.php'); ?>
</footer>