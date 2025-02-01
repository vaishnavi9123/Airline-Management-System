
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Employee List</title>
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
        background-color: grey; 
        color: white; 
        padding: 8px 18px; 
        font-size: 16px;
        border: none;
        border-radius: 6px;sty
        cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Employee List</h1>
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

            $conn = mysqli_connect($servername, $username, $password, $dbname);

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
            $sql = "SELECT * FROM employees;";
            $result = mysqli_query($conn, $sql);

            echo "<table class='flight-table'>";
            echo "<tr>";
            echo "<th>id</th>";
            echo "<th>Employee Name</th>";
            echo "<th>Date Of Birth</th>";
            echo "<th>Contact Number</th>";
            echo "<th>Email Address</th>";
            echo "<th>Employee Type</th>";
            echo "<th>Employee Salary</th>";
            echo "<th>Edit</th>";
            echo "<th>Delete</th>";
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
                
        echo "<td><a href='edit_em.php?e_id={$row['e_id']}' class='edit-button'>Edit</a></td>";
                  
                    echo "<td><a href='delete_em.php?e_id={$row['e_id']}' class='delete-button'>Delete</a></td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No record available.</td></tr>";
            }
            
            echo "</table>";
        
            $result1 = $conn->query("SET @p0='';");

            // Fetch the result from the user-defined variable @p0
            if ($result1) {
                $conn->next_result();

                $result = $conn->query("CALL `Num_of_employees`(@p0);");
                if ($result) {
                    // Fetch the result
                    $row = $result->fetch_assoc();
                    $Total_employees = $row['Total_employees'];
                } else {
                    // Handle error
                    echo "Error fetching result: " . $conn->error;
                }
            } else {
                // Handle error
                echo "Error calling stored procedure: " . $conn->error;
            }

            // Close the database connection
            $conn->close();
            ?>
        </section>
    </main>
    <button class="btn" style="margin-right: 1057px;"><a href="employee_details.php" style="text-decoration: none; color: white;">Add employee</a></button>
    <button class="btn"><a href="employee_inirec.php" style="text-decoration: none; color: white;">Employees record</a></button>
    <footer>
    <div class="b" id="Total_employees"><strong>Total Employees: </strong><?php echo $Total_employees; ?></div>
        </footer>
</body>
</html>

