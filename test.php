<div class="container-fluid">
    <div class="row px-5">
        <div class="col-lg-5 m-auto">
            <div class="card mt-5 bg-light">
                <div class="card-title text-center mt-3">
                    <img src="admin/images/logo.png" width="150px" height="150px">
                </div>
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user fa-2x"></i>
                                </span>
                            </div>
                            <input type="text" name="username" class="form-control py-4" placeholder="Tên đăng nhập" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock fa-2x"></i>
                                </span>
                            </div>
                            <input type="password" name="password" class="form-control py-4" placeholder="Mật khẩu">
                        </div>
                        <input type="submit" name="login" value="Đăng nhập" class="btn btn-success px-5">
                        <a href="?pageLayout=register" class="btn btn-primary px-5">Đăng ký</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
Login