<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOME</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!--Navbar-->
<nav class="navbar bg-white navbar-expand-lg navbar-light bg-body-tertiary py-3 fixed-top">
    <div class="container">
        <img class="logo" src="assets/imgs/logo.png" alt="">
        <h2 class="brand">DRIPKING</h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="account.php"><i class="fa-solid fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--Account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <h3 class="font-weight-bold">Thông Tin Tài Khoản</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Tên<span>Đức</span></p>
                <p>Email<span>duc@gmail.com</span></p>
                <p><a href="" id="order-btn">Đơn Hàng Của Bạn</a></p>
                <p><a href="" id="logout-btn">Đăng Xuất</a></p>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <form action="" id="account-form">
                <h3>Đổi Mật Khẩu</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label for="account-password">Password</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="account-password-confirm">Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirm-password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Change Password" class="btn" id="change-pass-btn">
                </div>
            </form>
        </div>
    </div>
</section>


<!--Orders-->
<section class="orders container my-5 py-3">
    <div class="container mt-2">
        <h2 class="font-weight-bold text-center">Giỏ hàng của bạn</h2>
        <hr class="mx-auto">

        <table class="mt-5 pt-5">
            <tr>
                <th>Sản phẩm</th>
                <th>Ngày Mua</th>
            </tr>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/drip7.png" alt="">
                        <div>
                            <p class="mt-3">NK SYNA</p>
                        </div>
                    </div>
                </td>

                <td>
                    <span>2025-5-14</span>
                </td>


            </tr>
        </table>


    </div>
</section>


<!--Footer-->
<footer class="mt-5 py-5">
    <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img class="logo" src="assets/imgs/logo.png" alt="">
            <p class="pt-3">Best Local Drip Store You Can Find</p>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Danh Mục</h5>
            <ul class="text-uppercase">
                <li><a href="#">Trang Phục</a></li>
                <li><a href="#">Giày</a></li>
                <li><a href="#">Jacket</a></li>
                <li><a href="#">Jeans</a></li>
            </ul>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Liên Hệ Chúng Tôi</h5>
            <div>
                <h6 class="text-uppercase">Địa Chỉ</h6>
                <p>Việt Nam,Trái Đất</p>
            </div>
            <div>
                <h6 class="text-uppercase">Số Điện Thoại</h6>
                <p>0123456789</p>
            </div>
            <div>
                <h6 class="text-uppercase">Email</h6>
                <p>c975246@gmail.com</p>
            </div>
        </div>
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Instagram</h5>
            <div class="row">
                <img src="assets/imgs/footer1.jpg" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="assets/imgs/footer1.jpg" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="assets/imgs/footer1.jpg" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="assets/imgs/footer1.jpg" alt="" class="img-fluid w-25 h-100 m-2">
                <img src="assets/imgs/footer1.jpg" alt="" class="img-fluid w-25 h-100 m-2">
            </div>
        </div>
    </div>

    <div class="copyright mt-5">
        <div class="row container mx-auto">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <img src="assets/imgs/payments.jpg" alt="">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 text-nowrap mb-2">
                <p>DRIPKING @ 2025 All Right Reserved</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>

</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>