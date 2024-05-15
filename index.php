<?php
$sn = "localhost";
$un = "root";
$p = "";
$db = "companies";

$c = new mysqli($sn, $un, $p, $db);

$sql = "SELECT name, image_url FROM companies_list";
$res = $c->query($sql);

$data = array();
if ($res) {
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
    }
}

$url_data = array();
foreach ($data as $item) {
    $url_data[] = $item['image_url'];
}

// Get random keys based on the number of elements in $url_data
$num_elements = count($url_data);
$rand_keys = ($num_elements >= 10) ? array_rand($url_data, 10) : array_rand($url_data, $num_elements);
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
                    <li><a href="home_demo.php"><button id="nb1">Home</button></a></li>
                    <li><a href="about_us.html"><button id="nb2">About Us!</button></a></li>
                    <li><a href="/Login/Login.php"><button id="nb3">Login</button></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="wrapper">
            <?php
            // Display the randomly selected images
            foreach ($rand_keys as $index) {
                echo '<img src="' . $url_data[$index] . '" alt="Company Image">';
            }
            ?>
        </div>
    </div>
    <div class="button">
        <form name="f1" action="action.php" method="post" id="f1">
        <?php
        foreach ($data as $item) {
            echo '<input type="submit" class="buttons" name="'.$item['name'].'" value="'.$item['name'].'">';
        }
        ?>
        </form>
    </div>
</body>
</html>
