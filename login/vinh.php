<?php
    
    $msg = '';

    function isLogin($username, $password){
        include('db.php');
        $flag = false;
        // Define your SQL query with a WHERE clause
        $condition = "username = '$username' and password = '$password'"; // e.g., "column_name = 'value'"

        // SQL query to fetch all table names in the database
        $sql = "SELECT *FROM user where $condition";

        $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            $flag = true;
        }
        
        // Close the database connection
        $conn->close();
        return $flag;
    }
    
    if (isset($_POST['login']) && !empty($_POST['username']) 
        && !empty($_POST['password'])) {      
        if (isLogin($_POST['username'], $_POST['password'])) {
            
            $_SESSION['username'] = $_POST['username'];
            
            echo 'You have entered valid use name and password';
            header("Location:index.php");
        }else {
            echo 'Wrong username or password';
        }
    }
    ?>