<?php?>
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

<!--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>-->

    <script>
        var mainImg =  document.getElementById("mainImg");
        var smallImg = document.getElementsByClassName("small-img");

        for (let i = 0;i < 4;i ++) {
            smallImg[i].onclick = function () {
                mainImg.src = smallImg[i].src;
            }
        }
    </script>
</footer>
