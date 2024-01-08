<?php
session_start();
include("../db.php");
if (isset($_GET["productID"])) {
    $productID = $_GET["productID"];
    $sqlDelete = "DELETE FROM carts WHERE productID = '$productID'";
    $result = $conn->query($sqlDelete);

    foreach ($_SESSION['cartItem'] as $key => $item) {
    if ($item['productID'] === $_GET["productID"]) {
        unset($_SESSION['cartItem'][$key]); // Xóa phần tử khỏi mảng
        $_SESSION['cartNumber']--; //giảm số lượng hiển thị
    }
}
header ("Location: viewCart.php");
}
?>