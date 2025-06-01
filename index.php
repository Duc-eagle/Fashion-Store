<?php
session_start();
ob_start();

include_once ('admin/Config/connect.php');

?>
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

<?php
// Debug: In ra giá trị của pageLayout
echo "pageLayout = " . (isset($_GET['pageLayout']) ? $_GET['pageLayout'] : 'not set') . "<br>";

if(isset($_GET['pageLayout'])) {
    $page = $_GET['pageLayout'];
    switch ($page) {
        case 'register':
            include_once('register.php');
            break;
        case 'login':
            include_once('login.php');
            break;
        case 'singleProduct':
            include_once('single_product.php');
            break;
        case 'cart':
            include_once('cart.php');
            break;
        case 'shop':
            include_once('shop.php');
            break;
        case 'shopcostume':
            include_once('shopCostume.php');
            break;
        case 'shopjacket':
            include_once('shopJacket.php');
            break;
        case 'shopjeans':
            include_once('shopJeans.php');
            break;
        case 'shopshoes':
            include_once('shopShoes.php');
            break;
        case 'success':
            include_once('success.php');
            break;
        case 'logout':
            include_once('logout.php');
            break;
        case 'contact':
            include_once('contact.php');
            break;
        default:
            include_once('dashboard.php');
    }
} else {
    include_once('dashboard.php');
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>