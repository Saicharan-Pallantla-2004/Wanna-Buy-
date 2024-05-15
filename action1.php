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
    $sql = "SELECT * FROM $clickedButton"; // Use the table name in the query
    $res = $c->query($sql);
    $data = array();
    if ($res) {
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Company Data</title>
    <style>
        * {
    padding: 0;
    margin: 0;
}

body {
    background: url("HOME BG1.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    height: 110vh;
    margin: 0;
    padding: 0;
    background-attachment: fixed;
}

.navbar {
    padding-left: 15px;
    padding-right: 15px;
    height: 5px;
}

.navdiv {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

li {
    list-style: none;
    display: inline-block;
}

li a {
    color: white;
    font-size: 20px;
    font-weight: bold;
    margin-right: 25px;
}

#nb1, #nb2,#nb3 {
    width: 90px;
    height: 35px;
    background-color: rgb(4, 181, 4);
    color: white;
    font-size: 15px;
    border: none;
    margin-top: 20px;
}

#logoimg{
    border-radius: 10px;
    margin-top: 5px;
    width: 150px;
}

#nb1:hover{
    box-shadow: 0 0 10px green,
    0 0 50px green,
    0 0 100px green,
    0 0 400px green;
-webkit-box-reflect: below 1px linear-gradient(transparent, #0005);
border-radius: 8px;
}

#nb2:hover{
    box-shadow: 0 0 10px green,
    0 0 50px green,
    0 0 100px green,
    0 0 400px green;
-webkit-box-reflect: below 1px linear-gradient(transparent, #0005);
border-radius: 8px;
}

#nb3:hover{
    box-shadow: 0 0 10px green,
    0 0 50px green,
    0 0 100px green,
    0 0 400px green;
-webkit-box-reflect: below 1px linear-gradient(transparent, #0005);
border-radius: 8px;
}

#title {
    margin-left: 170px;
    margin-top: -65px;
    color: white;
    font-size: 40px;
}

#nb1 {
    margin-right: 25px;
}

#nb2 {
    margin-right: 50px;
}

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top:200px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        td{
            color:white;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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
<?php
if (!empty($data)) {
    echo "<table>";
    // Print table headers
    echo "<tr>";
    foreach ($data[0] as $key => $value) {
        echo "<th>$key</th>";
    }
    echo "</tr>";
    // Print table rows
    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data available.";
}
?>
</div>
</body>
</html>
