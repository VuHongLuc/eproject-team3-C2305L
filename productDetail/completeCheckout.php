<?php
session_start();
include("../db.php");

unset($_SESSION['cartNumber']);
unset($_SESSION['cartItem']);

$truncateTableCart = "TRUNCATE TABLE `eproject`.`carts`;";
$resultTruncateTableCart = $conn ->query($truncateTableCart);

header ("Location: ../index/index.php");
?>