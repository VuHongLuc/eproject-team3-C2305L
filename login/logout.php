<?php
session_start();
        unset($_SESSION['userName']); // Xóa phần tử khỏi mảng
header ("Location: ../index/index.php");

?>