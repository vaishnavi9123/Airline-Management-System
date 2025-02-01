<?php
session_start();
if(isset($_POST['u_name'])){
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "airio_";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

// Get the entered username and password from the HTML form
$u_name = $_POST["u_name"];
$u_password = $_POST["u_password"];

// Query the database to fetch the hashed password for the entered username
$sql = "SELECT u_password FROM passenger_reg WHERE u_name = '$u_name';";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // Username exists, check the password
    $row = $result->fetch_assoc();
    $hashedPasswordFromDB = $row["u_password"];

    if ($u_password==$hashedPasswordFromDB) {
        $_SESSION['u_name'] = $u_name;
        // Password is correct, redirect to the desired page
        header("Location: passenger_h.html");
        exit();
    } else {
        // Incorrect password
        echo "Incorrect password. Please try again.";
    }
} else {
    // Username does not exist
    echo "Username not found. Please try again.";
}

// Close the database connection
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Passenger login</title>
    <link rel="stylesheet" href="css/style_l.css">
</head>
<body>
    <img class="log" src="images/login.jpeg" alt="login">
    <div class="container">
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label class="form_" for="form1">Username:</label>
        <input type="text" name="u_name" id="u_name" placeholder="Enter username" required>
        <label class="form_" for="form1">Password:</label>
        <input type="password" name="u_password" id="u_password" placeholder="Enter password" required>
        <button class="btn center-text">
  <a href="index.html" style="text-decoration: none; color: black;">Back</a>
    </button>

        <button type="submit" class="btn" style="width: 70px;">Login</button>
        <a class="nav-link" href="passenger_reg.php">Register here</a>
    </form>
    </div>
        </body>
        </html>

        