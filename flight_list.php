<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Flight List</title>
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
        <h1>Flight List</h1>
    </header>
    <button class="btn"><a href="admin_h.html" style="text-decoration: none; color: white;">Back</a></button>
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
                $flight_id = $_GET['delete'];
                // Delete the flight record from the database
                $deleteSql = "DELETE FROM flight_details WHERE flight_id = $flight_id;";
                if (mysqli_query($conn, $deleteSql) === TRUE) {
                    echo "<p class='success'>Flight deleted successfully.</p>";
                } else {
                    echo "<p class='error'>Error deleting flight: " . $conn->error . "</p>";
                }
            }

            // SQL query to retrieve flight data
            $sql = "SELECT * FROM flight_details;";
            $result = mysqli_query($conn, $sql);

            echo "<table class='flight-table'>";
            echo "<tr>";
            echo "<th>id</th>";
            echo "<th>From</th>";
            echo "<th>To</th>";
            echo "<th>Seats</th>";
            echo "<th>Departure Time</th>";
            echo "<th>Arrival Time</th>";
            echo "<th>Airport Name</th>";
            echo "<th>Airport Address</th>";
            echo "<th>First Class Price</th>";
            echo "<th>Business Class Price</th>";
            echo "<th>Premium Economy Price</th>";
            echo "<th>Economy Class Price</th>";
            echo "<th>Edit</th>";
            echo "<th>Delete</th>";
            echo "</tr>";

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['flight_id']}</td>";
                    echo "<td>{$row['d_city']}</td>";
                    echo "<td>{$row['a_city']}</td>";
                    echo "<td>{$row['seats']}</td>";
                    echo "<td>{$row['d_time']}</td>";
                    echo "<td>{$row['a_time']}</td>";
                    echo "<td>{$row['airport_name']}</td>";
                    echo "<td>{$row['airport_address']}</td>";
                    echo "<td>{$row['first_class_cost']}</td>";
                    echo "<td>{$row['business_class_cost']}</td>";
                    echo "<td>{$row['pre_economy_class_cost']}</td>";
                    echo "<td>{$row['economy_class_cost']}</td>";            // Add an "Edit" button with a link to the edit page
                    echo "<td><a href='edit_flight.php?flight_id={$row['flight_id']}' class='edit-button'>Edit</a></td>";
                  
                    echo "<td><a href='delete_flight.php?flight_id={$row['flight_id']}' class='delete-button'>Delete</a></td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No flights available.</td></tr>";
            }

            echo "</table>";

            // Close the database connection
            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <p>2023 Flight List</p>
    </footer>

</body>
</html>

