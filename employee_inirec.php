<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Initial Employee Record</title>
    <link rel="stylesheet" href="css/style_fli_l.css">
    <style>
        .flight-table {
            border-collapse: collapse;
            width: 100%;
        }

        .flight-table th, .flight-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .flight-table th {
            background-color: #f2f2f2;
        }

        .flight-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn{
        background-color: grey; /* Change the button color */
        color: white; /* Change the text color */
        padding: 10px 20px; /* Increase padding for a bigger button */
        font-size: 16px; /* Increase font size */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1> Initial Employee List</h1>
    </header>
    <button class="btn"><a href="employees.php" style="text-decoration: none; color: white;">Back</a></button>
    <main>
        <section class="flight-list">
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

            // Check if a flight has been deleted
            if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
                $e_id = $_GET['delete'];
                // Delete the flight record from the database
                $deleteSql = "DELETE FROM employees WHERE e_id = $e_id;";
                if (mysqli_query($conn, $deleteSql) === TRUE) {
                    echo "<p class='success'>Record deleted successfully.</p>";
                } else {
                    echo "<p class='error'>Error deleting Record: " . $conn->error . "</p>";
                }
            }

            // SQL query to retrieve data
            $sql = "SELECT * FROM employees_backup;";
            $result = mysqli_query($conn, $sql);

            echo "<table class='flight-table'>";
            echo "<tr>";
            echo "<th>id</th>";
            echo "<th>Employee Name</th>";
            echo "<th>Date Of Birth</th>";
            echo "<th>Contact Number</th>";
            echo "<th>Email Address</th>";
            echo "<th>Employee Type</th>";
            echo "<th>Employee Salary</td>";
            echo "<th>Date_Time</th>";
            echo "</tr>";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['e_id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['dob']}</td>";
                    echo "<td>{$row['contact_no']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['type']}</td>";
                    echo "<td>{$row['salary']}</td>";
                    echo "<td>{$row['date_time']}</td>";
                
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No record available.</td></tr>";
            }

            echo "</table>";

            // Close the database connection
            $conn->close();
            ?>
        </section>
    </main>
    <footer>
        <p>2023 Initial Employees Record</p>
    </footer>

</body>
</html>

