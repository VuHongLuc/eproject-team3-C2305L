<?php
session_start();
foreach ($_SESSION['cartItem'] as $key => $item) {
    if ($item['productID'] === $_GET["productID"]) {
        unset($_SESSION['cartItem'][$key]); // Xóa phần tử khỏi mảng
        $_SESSION['cartNumber']--; //giảm số lượng hiển thị
    }
}
header ("Location: viewCart.php");

?>