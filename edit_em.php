<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Edit Emplyee Record</title>
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
        <h1>Edit Employee Record</h1>
    </header>
    <button class="btn"><a href="employees.php" style="text-decoration: none; color: black;">Back</a></button>

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
                $e_id = $_GET['e_id'];

                // Retrieve the edited flight details from the form
                $name = $_POST["name"];
                $dob = $_POST["dob"];
                $contact_no =$_POST["contact_no"];
                $email = $_POST["email"];
                $type = $_POST["type"];
                $salary = $_Post["salry"];
                
                $updateSql = "UPDATE employees SET
                    name = '$name',
                    dob = '$dob',
                    contact_no = '$contact_no',
                    email = '$email',
                    type = '$type',
                    salary = '$salary'
                    WHERE e_id = $e_id;";

                if (mysqli_query($conn, $updateSql) === TRUE) {
                    echo "<p class='success'>Record details updated successfully.</p>";
                } else {
                    echo "<p class='error'>Error updating employee details: " . $conn->error . "</p>";
                }
            }

            // Get the flight details for editing
            $e_id = $_GET['e_id'];
            $selectSql = "SELECT * FROM employees WHERE e_id = $e_id;";
            $result = mysqli_query($conn, $selectSql);

            echo "<form method='post'>";
            echo "<table class='flight-table'>";
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display an edit form with flight details
                echo "<tr><th>Field</th><th>Value</th></tr>";
                echo "<tr><td>Employee Name:</td><td><input type='text' name='name' value='{$row['name']}'></td></tr>";
                echo "<tr><td>Date Of Birth:</td><td><input type='date' name='dob' value='{$row['dob']}'></td></tr>";
                echo "<tr><td>Contact Number:</td><td><input type='number' name='contact_no' value='{$row['contact_no']}'></td></tr>";
                echo "<tr><td>Email:</td><td><input type='email' name='email' value='{$row['email']}'></td></tr>";
                echo "<tr><td>Employee Type:</td><td><input type='text' name='type' value='{$row['type']}'></td></tr>";
                echo "<tr><td>Employee Salary:</td><td><input type='number' name='salary' value='{$row['salary']}'></td></tr>";
                echo "</table>";
                echo "<div class='center'><input type='submit' value='Save Changes' class='save-changes-button'></div><br>";
                echo "</form>";
            } else {
                echo "<p class='error'>Record not found.</p>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <p>2023 employees List</p>
    </footer>
</body>
</html>
