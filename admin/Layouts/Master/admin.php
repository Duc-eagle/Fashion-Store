<?php?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DRIPKING Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="sidebar">
    <h2 class="text-center py-3">DRIPKING</h2>
    <a class="<?php if (!isset($_GET['page_layout'])){ echo 'active';}?>" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a class="<?php if (isset($_GET['page_layout']) && $_GET['page_layout'] == 'user'){ echo 'active';}?>" href="?page_layout=user"><i class="fas fa-users"></i> Quản lý thành viên</a>
    <a class="<?php if (isset($_GET['page_layout']) && $_GET['page_layout'] == 'category'){ echo 'active';}?>" href="?page_layout=category"><i class="fas fa-list"></i> Quản lý danh mục</a>
    <a class="<?php if (isset($_GET['page_layout']) && $_GET['page_layout'] == 'product'){ echo 'active';}?>" href="?page_layout=product"><i class="fas fa-box"></i> Quản lý sản phẩm</a>
    <a class="<?php if (isset($_GET['page_layout']) && $_GET['page_layout'] == 'order'){ echo 'active';}?>" href="?page_layout=order"><i class="fa-solid fa-bag-shopping"></i> Quản lý đơn hàng</a>

</div>

<!--Master Layout-->
<?php
    if (isset($_GET['page_layout'])) {
        switch ($_GET['page_layout']) {
            case 'product' : include_once('Layouts/Product/product.php'); break;
            case 'category' : include_once('Layouts/Categories/category.php'); break;
            case 'user' : include_once('Layouts/User/user.php'); break;
            case 'addCategory' : include_once('Layouts/Categories/add_category.php'); break;
            case 'addProduct' : include_once('Layouts/Product/add_product.php'); break;
            case 'editProduct' : include_once('Layouts/Product/edit_product.php'); break;
            case 'deleteProduct' : include_once('Layouts/Product/delete_product.php'); break;
            case 'order' : include_once ('Layouts/Orders/order.php'); break;
            case 'order_detail' : include_once ('Layouts/Orders/order_detail.php'); break;
        }
    } else {
        include_once('Layouts/Master/dashboard.php');
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
