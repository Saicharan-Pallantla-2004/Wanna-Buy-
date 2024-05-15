<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "companies";
    $conn = new mysqli($servername, $username, $password, $db);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        
        // Prepare and execute SQL query
        $sql = "SELECT * FROM administrator_login WHERE USER_NAME = '$uname' AND PASSWORD = '$pass'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Valid user, redirect to modify.php
            header("Location: modify.php?valid=true");
            exit();
        } else {
            // Invalid user, redirect to login page with error message
            header("Location: login.php?valid=false");
            exit();
        }
    }
?>
