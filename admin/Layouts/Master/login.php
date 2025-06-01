<?php

if (isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //tìm kiếm bản ghi tương ứng trong CSDL
    $sql = "SELECT * FROM users WHERE `user_name` = '$username' AND `user_password` = '$password'";
    $query = mysqli_query($connect , $sql);
    //Đếm số lượng bản ghi thỏa mãn
    $check = mysqli_num_rows($query);
    //Xác thực dữ liệu và tạo session
    if ($check == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: index.php');
    } else {
        $error = '<div class="alert alert-danger text-center mt-3" role="alert">Tài khoản không hợp lệ!</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập - Online DRIPKING</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
<div class="card p-4 shadow" style="width: 350px;">
    <h2 class="text-center">Online DRIPKING - Administrator</h2>
    <?php
    if (isset($error)) {
        echo $error;
    }
    ?>
    <form role="form" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="username" class="form-label">Tài khoản</label>
            <input type="text" class="form-control" id="username" name="username"  required placeholder="Tài khoản">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Nhớ tài khoản</label>
        </div>
        <button name="sbm" type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
