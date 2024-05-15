<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Text Area Example</title>
<style>
    body{
    background: url("https://localhost/MyWebsite/HOME%20BG1.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    height: 110vh;
    margin: 0;
    padding: 0;
    background-attachment: fixed;
    }
    .container{
        margin-top:200px
    }
/* CSS for form */
form {
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

/* CSS for table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
table td {
    color:white;
}
table th {
    background-color: #f2f2f2;
}

/* CSS for textarea */
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* CSS for submit button */
input[type="submit"] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* CSS for select dropdown */
select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* CSS for error message */
.error {
    color: red;
    font-weight: bold;
    margin-bottom: 10px;
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

</style>
</head>
<body>
<div class="body">
        <nav class="navbar">
            <div class="navdiv">
                <div class="logo">
                    <img src="https://localhost/MyWebsite/logo.jpeg" alt="Logo" height="85px" width="150px" id="logoimg">
                    <h1 id="title">Wanna Buy!</h1>
                </div>
                <ul>
                    <li><a href="https://localhost/MyWebsite/home_demo.php"><button id="nb1">Home</button></a></li>
                    <li><a href="https://localhost/MyWebsite/about_us.html"><button id="nb2">About Us!</button></a></li>
                    <li><a href="Login.php"><button id="nb3">Login</button></a></li>
                </ul>
            </div>
        </nav>
    </div>
<div class="container">
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$db = "companies";
$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching table names
$tables_query = "SHOW TABLES";
$tables_result = $conn->query($tables_query);

echo "<form method='post'>";
// Displaying tables in a dropdown
echo "<select name='table'>";
while ($row = $tables_result->fetch_row()) {
    echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
}
echo "</select>";
echo "<input type='submit' name='submit_table' value='Submit'>";
echo "</form>";

if(isset($_POST['submit_table'])) { // Check if table submission is made
    if(isset($_POST['table'])) {
        $selected_table = $_POST['table'];
        $data_query = "SELECT * FROM `$selected_table`"; // Enclosing table name in backticks
        $data_result = $conn->query($data_query);

        if ($data_result) { // Check if query executed successfully
            if ($data_result->num_rows > 0) {
                // Displaying data
                echo "<table border='1'>";
                echo "<tr>";
                while ($row = $data_result->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                        echo "<th>" . $key . "</th>";
                    }
                    break; // Display headers only once
                }
                echo "</tr>";

                $data_result->data_seek(0); // Reset result pointer to start
                while ($row = $data_result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                echo "<br><br><br>";
            } else {
                echo "No data found.";
            }
        } else {
            echo "Error: " . $conn->error; // Display any SQL error
        }
    }
}

?>

<form method="post"> <!-- Add form tag here -->
<!-- Text area -->
<textarea name="sql_query" rows="4" cols="50" placeholder="Enter your SQL query here..."></textarea><br>
<input type="submit" name="submit_query" value="Execute">
</form> <!-- Close form tag here -->

<?php
    if(isset($_POST['submit_query']) && isset($_POST['sql_query']) && !empty($_POST['sql_query'])) {
        $sql_query = $_POST['sql_query']; // Get the SQL query from the textarea
    
        // Execute the SQL query
        $result = $conn->query($sql_query);    
    }
?>
</div>
</body>
</html>