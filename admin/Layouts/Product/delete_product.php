<?php

$product_id = $_GET['product_id'];
$sql = "DELETE FROM products WHERE `product_id` = $product_id";
mysqli_query($connect , $sql);
header('location: ?page_layout=product');
?>
