<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "companies";

// Create connection
$c = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($c->connect_error) {
    die("Connection failed: " . $c->connect_error);
}

if (!empty($_POST)) {
    // Check if any button was clicked
    $clickedButton = key($_POST); // Get the first key from the $_POST array
    $clickedButton = $c->real_escape_string($clickedButton); // Sanitize the input
    // Assuming $clickedButton contains the table name
    $sql = "SELECT name, image_url FROM $clickedButton"; // Use the table name in the query
    $res = $c->query($sql);
    $data = array();
    if ($res) {
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
    // Output the result, you might want to use json_encode for a more structured output
}
$url_data = array();
foreach ($data as $item) {
    $url_data[] = $item['image_url'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wanna Buy!</title>
    <link rel="stylesheet" href="https://localhost/MyWebsite/login_demo.css">
</head>
<body>
    <div class="body">
        <nav class="navbar">
            <div class="navdiv">
                <div class="logo">
                    <img src="logo.jpeg" alt="Logo" height="85px" width="150px" id="logoimg">
                    <h1 id="title">Wanna Buy!</h1>
                </div>
                <ul>
                    <li><a href="https://localhost/MyWebsite/home_demo.php"><button id="nb1">Home</button></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="wrapper">
            <?php
            // Display the randomly selected images
            foreach ($url_data as $url) {
                echo '<img src="' . $url . '" alt="Company Image" height="300px" width="500px">';
            }
            ?>
        </div>
    </div>
    <div class="button">
        <form name="f1" action="action1.php" method="post" id="f1">
        <?php
        foreach ($data as $item) {
            echo '<input type="submit" class="buttons" name="'.$item['name'].'" value="'.$item['name'].'">';
        }
        ?>
        </form>
    </div>
</body>
</html>