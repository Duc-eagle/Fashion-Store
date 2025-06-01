<?php
$sql = "SELECT * FROM categories ORDER BY cate_id ASC LIMIT 5";
$query = mysqli_query($connect , $sql);
$row = mysqli_num_rows($query);
?>
<li class="nav-item dropdown">
    <a href="index.php?pageLayout=shop" class="nav-link dropdown-toggle" id="shopDropdown" role="button">
        Shop
    </a>
    <ul class="dropdown-menu" aria-labelledby="shopDropdown">
        <?php
        while ($item = mysqli_fetch_array($query)) {
            $category = strtolower($item['cate_name']);
        ?>
            <li><a class="dropdown-item" href="index.php?pageLayout=shop<?= $category ?>"><?= $item['cate_name'] ?></a></li>
        <?php
        }
        ?>
<!--        <li><a class="dropdown-item" href="shop.php?option2">Lựa chọn 2</a></li>-->
    </ul>
</li>