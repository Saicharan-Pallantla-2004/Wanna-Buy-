<?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include database connection file
        include("login_connection.php");

        // Get username and password from form
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        // SQL query to check if username and password exist in the database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        // Check if query was successful
        if ($result) {
            // Check if any row was returned
            if (mysqli_num_rows($result) == 1) {
                // Valid credentials, redirect to a success page or perform any other action
                header("Location: success.php");
                exit();
            } else {
                // Invalid credentials, redirect back to login page with error message
                header("Location: login.php?valid=false");
                exit();
            }
        } else {
            // Query failed, redirect back to login page with error message
            header("Location: login.php?valid=false");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
    <link href='Login.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="uname" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="pass" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <?php
        // Display error message if present
        if (isset($_GET['valid']) && $_GET['valid'] == 'false') {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    ?>
</body>
</html>
