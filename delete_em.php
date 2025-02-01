<?php
// Database connection configuration
$servername = "localhost:3308";
$username = "root";
$password = "";
$dbname = "airio_";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['e_id']) && is_numeric($_GET['e_id'])) {
    $e_id = $_GET['e_id'];

    // SQL query to delete the flight record
    $deleteSql = "DELETE FROM employees WHERE e_id = $e_id;";

    if (mysqli_query($conn, $deleteSql)) {
        // Flight deleted successfully
        echo "success";
    } else {
        // Error deleting flight
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Invalid flight ID
    echo "Invalid flight ID";
}

// Close the database connection
mysqli_close($conn);
?>
