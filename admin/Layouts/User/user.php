
<div class="main-content">
    <div class="top d-flex justify-content-between align-items-center">
        <h2>Quản lý thành viên</h2>
        <input type="text" class="form-control w-25" placeholder="Search">
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                <i class="fa-solid fa-user"></i>
<!--                Admin-->
                <?= $_SESSION['username'] ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                <li><a class="dropdown-item" href="Layouts/Master/logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </div>
    <div class="table-container mt-5">
        <button class="btn btn-primary my-3"><i class="fas fa-user-plus"></i> Thêm thành viên</button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>admin</td>
                <td>-</td>
                <td>c975246@gmail.com</td>
                <td>Administrator</td>
                <td>
                    <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                    <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Xem</button>
                </td>
            </tr>
            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>
                    <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                    <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Xem</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

