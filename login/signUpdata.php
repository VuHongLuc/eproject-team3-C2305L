<?php
session_start();
include('../db.php');

if (
    !empty($_POST['username']) && !empty($_POST['password'])
    && !empty($_POST['dob']) && !empty($_POST['phone'])
    && !empty($_POST['email']) && !empty($_POST['address'])
) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $roleUser = $_POST['roleUser'];

    function convertToDate($day)
    {
        $date = strtotime($day);
        return date("y-m-d", $date);
    }

    $dateIntoDb = convertToDate($dob);

   
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO `user` (userName, password, dob, address, phone, email, roleUser)
    VALUES ('$username', '$hashedPassword', '$dateIntoDb','$address', '$phone', '$email','$roleUser')";

    $result = $conn->query($query);

    if ($result !== false) {

        header('Refresh: 1; URL = login.php');
        echo "<script>
        swal({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
            button: 'Aww yiss!'
        });
      </script>";
    } else {
        echo "Fail Register";
    }
}
?>
