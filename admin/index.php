<?php
//đối tượng
ob_start();
//session
session_start();

define('SECURITY' , true);

include_once ('Config/connect.php');

//Kiểm tra phiên đăng nhập
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    include_once ('Layouts/Master/admin.php');
} else {
    include_once ('Layouts/Master/login.php');
}


?>
