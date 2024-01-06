<?php
session_start();
foreach ($_SESSION['compareItems'] as $key => $item) {
    if ($item['productID'] === $_GET["productID"]) {
        unset($_SESSION['compareItems'][$key]); // Xóa phần tử khỏi mảng
        $_SESSION['numberCompare']--; //giảm số lượng hiển thị
    }
}
header ("Location: compare.php");

?>