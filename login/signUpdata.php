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

    $checkUserName = "SELECT userName FROM `eproject`.`user`";
    $resultCheckUserName = $conn->query($checkUserName);
    $flagCheckUserName = true;
        if ($resultCheckUserName->num_rows > 0) {
            $rowUserNames = $resultCheckUserName->fetch_assoc();
            foreach ($rowUserNames as $rowUserName){
                if ($rowUserName === $username){
                    $flagCheckUserName = false;
                }
            }}
    if($flagCheckUserName){
        $query = "INSERT INTO `user` (userName, password, dob,  address, phone, email, roleUser)
        VALUES ('$username', '$hashedPassword',  '$dob', '$address', '$phone', '$email', '$roleUser')";
    
        $result = $conn->query($query);
    
        if ($result === TRUE) {
            echo '<script>alert("Successfully Register")</script>';
            header('Refresh: 1; URL = login.php');
        } else {
            echo "Fail Register";
        }

    }else{
        echo '<script>alert("Username is already taken!\nPlease use another username!")</script>';
        header('Refresh: 0; URL = login.php');

    }

    
}
?>
