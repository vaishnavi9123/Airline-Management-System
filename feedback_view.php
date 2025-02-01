<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            background-color: gray;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #555;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <h1>View Feedbacks</h1>
    </header>
    <div class="container">
        <button class="btn"><a href="admin_h.html" style="text-decoration: none; color: white;">Back</a></button>
        <main>
            <section class="feedback-list">
                <?php
                // Database connection configuration
                $servername = "localhost:3308"; // Change to your database server name
                $username = "root"; // Change to your database username
                $password = ""; // Change to your database password
                $dbname = "airio_"; // Change to your database name

                // Create a connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // SQL query to retrieve feedback data
                $sql = "SELECT name, email, que_1, que_2 FROM feedback;";
                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Feedback for Question 1</th>";
                    echo "<th>Feedback for Question 2</th>";
                    echo "</tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['que_1']}</td>";
                        echo "<td>{$row['que_2']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<br>No feedback available.";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </section>
        </main>
    </div>

    <footer>
        <p>&copy; 2023 Feedback</p>
    </footer>
</body>
</html>
