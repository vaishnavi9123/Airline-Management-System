<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Edit Flight</title>
    <link rel="stylesheet" href="css/style_edit.css">
    <style>
        .flight-table {
            border-collapse: collapse;
            width: 100%;
        }

        .flight-table th, .flight-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .flight-table th {
            background-color: #f2f2f2;
        }

        .flight-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    /* Add CSS styles for the Save Changes button */
    .save-changes-button {
        background-color: grey; /* Change the button color */
        color: white; /* Change the text color */
        padding: 10px 20px; /* Increase padding for a bigger button */
        font-size: 16px; /* Increase font size */
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Center the Save Changes button */
    .center {
        display: flex;
        justify-content: center;
        margin-top: 20px; /* Adjust the margin as needed */
    }
</style>

    
</head>
<body>
    <header>
        <h1>Edit Flight</h1>
    </header>
    <button class="btn"><a href="flight_list.php" style="text-decoration: none; color: black;">Back</a></button>

    <main>
        <section class="edit-flight-form">
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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get flight ID from the URL
                $flight_id = $_GET['flight_id'];

                // Retrieve the edited flight details from the form
                $d_city = $_POST["d_city"];
                $a_city = $_POST["a_city"];
                $seats = $_POST["seats"];
                $d_time = $_POST["d_time"];
                $a_time = $_POST["a_time"];
                $airport_name = $_POST["airport_name"];
                $airport_address = $_POST["airport_address"];
                $first_class_cost = $_POST["first_class_cost"];
                $business_class_cost = $_POST["business_class_cost"];
                $pre_economy_class_cost = $_POST["pre_economy_class_cost"];
                $economy_class_cost = $_POST["economy_class_cost"];

                // Update flight details in the database
                $updateSql = "UPDATE flight_details SET
                    d_city = '$d_city',
                    a_city = '$a_city',
                    seats = '$seats',
                    d_time = '$d_time',
                    a_time = '$a_time',
                    airport_name = '$airport_name',
                    airport_address = '$airport_address',
                    first_class_cost = '$first_class_cost',
                    business_class_cost = '$business_class_cost',
                    pre_economy_class_cost = '$pre_economy_class_cost',
                    economy_class_cost = '$economy_class_cost'
                    WHERE flight_id = $flight_id;";

                if (mysqli_query($conn, $updateSql) === TRUE) {
                    echo "<p class='success'>Flight details updated successfully.</p>";
                } else {
                    echo "<p class='error'>Error updating flight details: " . $conn->error . "</p>";
                }
            }

            // Get the flight details for editing
            $flight_id = $_GET['flight_id'];
            $selectSql = "SELECT * FROM flight_details WHERE flight_id = $flight_id;";
            $result = mysqli_query($conn, $selectSql);

            echo "<form method='post'>";
            echo "<table class='flight-table'>";
            if ($result->num_rows > 0) {
                
                $row = $result->fetch_assoc();
                // Display an edit form with flight details
                echo "<tr><th>Field</th><th>Value</th></tr>";
                echo "<tr><td>From:</td><td><input type='text' name='d_city' value='{$row['d_city']}'></td></tr>";
                echo "<tr><td>To:</td><td><input type='text' name='a_city' value='{$row['a_city']}'></td></tr>";
                echo "<tr><td>Seats:</td><td><input type='number' name='seats' value='{$row['seats']}'></td></tr>";
                echo "<tr><td>Departure Time:</td><td><input type='text' name='d_time' value='{$row['d_time']}'></td></tr>";
                echo "<tr><td>Arrival Time:</td><td><input type='text' name='a_time' value='{$row['a_time']}'></td></tr>";
                echo "<tr><td>Airport Name:</td><td><input type='text' name='airport_name' value='{$row['airport_name']}'></td></tr>";
                echo "<tr><td>Airport Address:</td><td><input type='text' name='airport_address' value='{$row['airport_address']}' style='width: 600px;'></td></tr>";
                echo "<tr><td>First Class Price:</td><td><input type='number' name='first_class_cost' value='{$row['first_class_cost']}'></td></tr>";
                echo "<tr><td>Business Class Price:</td><td><input type='number' name='business_class_cost' value='{$row['business_class_cost']}'></td></tr>";
                echo "<tr><td>Premium Economy Price:</td><td><input type='number' name='pre_economy_class_cost' value='{$row['pre_economy_class_cost']}'></td></tr>";
                echo "<tr><td>Economy Class Price:</td><td><input type='number' name='economy_class_cost' value='{$row['economy_class_cost']}'></td></tr>";
                echo "</table>";
                echo "<div class='center'><input type='submit' value='Save Changes' class='save-changes-button'></div><br>";
                echo "</form>";
            } else {
                echo "<p class='error'>Flight not found.</p>";
            }

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