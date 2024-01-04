<?php
    include('../db.php');
    if (!empty($_POST['username']) && !empty($_POST['password'])
    && !empty($_POST['dob'])
    && !empty($_POST['phone']) && !empty($_POST['email'])
    && !empty($_POST['address'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $roleuser = $_POST['roleUser'];
    function convertToDate($day){
        $date = strtotime($day);
        return date("d-m-Y", $date);
    }

    $dateIntoDb = convertToDate($dob);

    $query = "INSERT INTO `user` (userName, password, dob,  address, phone, email,roleUser)
    VALUES ('$username', '$password',  '$dob','$address', '$phone', '$email','$roleuser')";

    $result = $conn->query($query);
     
    if($result !== false){
        echo "Successfully Register";
        header('Refresh: 3; URL = login.php');
    }else{
        echo "Fail Register";
    }
        
    }
    ?>