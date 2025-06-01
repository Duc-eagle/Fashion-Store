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
                    <a class="nav-link" href="index.html">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="shop.html">Shop</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="account.html"><i class="fa-solid fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--Checkout-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Check Out</h2>
        <hr class="mx-auto">
    </div>

    <div class="mx-auto container">
        <form action="" id="checkout-form">
            <div class="form-group checkout-small-element">
                <label for="checkout-name">Tên Tài Khoản</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Tên tài khoản" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for="checkout-email">Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for="checkout-phone">Số Điện Thoại</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Số Điện Thoại" required>
            </div>
            <div class="form-group checkout-small-element">
                <label for="checkout-city">Thành Phố</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Thành Phố" required>
            </div>
            <div class="form-group checkout-large-element">
                <label for="checkout-address">Địa Chỉ</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Địa Chỉ" required>
            </div>
            <div class="form-group checkout-btn-container">
                <input type="submit" class="btn" id="checkout-btn" value="Checkout">
            </div>
        </form>
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