<?php
session_start();
include_once('header.php');

// Kiểm tra nếu không có thông báo thành công thì chuyển về trang chủ
if(!isset($_SESSION['success'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="container mt-5 py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="alert alert-success mt-5" role="alert">
                <h4 class="alert-heading"><i class="fas fa-check-circle"></i> <?php echo $_SESSION['success']; ?></h4>
                <p>Cảm ơn bạn đã mua hàng tại DRIPKING. Đơn hàng của bạn sẽ sớm được vận chuyển.</p>
                <hr>
                <p class="mb-0">Bạn có thể tiếp tục mua sắm hoặc theo dõi đơn hàng của mình.</p>
                <div class="mt-4">
                    <a href="index.php" class="btn btn-primary me-2">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Xóa thông báo thành công sau khi hiển thị
unset($_SESSION['success']);
include_once('footer.php');
?> 