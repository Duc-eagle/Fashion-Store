<?php?>
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

                <?php include_once ('menu.php')?>

                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?pageLayout=contact">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a style="color: black" href="index.php?pageLayout=cart"><i class="fa-solid fa-cart-shopping"></i></a>
                </li>
                <?php
                if (isset($_SESSION['username'])) {
                ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="index.php?pageLayout=profile">Hồ sơ</a></li>
                            <li><a class="dropdown-item" href="index.php?pageLayout=logout">Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="index.php?pageLayout=login">Đăng nhập</a></li>
                        <li><a class="dropdown-item" href="index.php?pageLayout=register">Đăng ký</a></li>
                    </ul>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
