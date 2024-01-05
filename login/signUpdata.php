<?php
include('../db.php');

if (!empty($_POST['username']) && !empty($_POST['password'])
    && !empty($_POST['dob'])
    && !empty($_POST['phone']) && !empty($_POST['email'])
    && !empty($_POST['address'])) {
    $username = $_POST['username'];
    $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $roleUser = $_POST['roleUser'];

    function convertToDate($day){
        $date = strtotime($day);
        return date("Y-M-D", $date);
    }

    $dateIntoDb = convertToDate($dob);

    $query = "INSERT INTO `user` (userName, password, dob,  address, phone, email, roleUser)
    VALUES ('$username', '$hashedPassword',  '$dob', '$address', '$phone', '$email', '$roleUser')";

    $result = $conn->query($query);

    if ($result === TRUE) {
        echo "Successfully Register";
        header('Refresh: 3; URL = login.php');
    } else {
        echo "Fail Register";
    }
}
?>
