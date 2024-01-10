<?php 
session_start(); 
include "../db.php";

  if (isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

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
                if (!empty($_SESSION['previous_page'])){
                    header("Location: " . $_SESSION['previous_page']);
                  }
                  else {
                    header("Location: ../index/index.php");
                  }
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
