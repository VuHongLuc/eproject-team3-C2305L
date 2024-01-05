<?php 
session_start(); 
include "../db.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: login.php?error=User Name is required");
        exit();
    } elseif (empty($password)){
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE userName='$username'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['userName'] = $row['userName'];
                $_SESSION['password'] = $row['password'];
                header("Location: ../index/index.php");
                exit();
            } else {
                header("Location: login.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: login.php");
    exit();
}
?>
