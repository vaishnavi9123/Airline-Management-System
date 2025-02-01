<?php
session_start(); // Start the session

// Check if the user is logged in and their user_name is set in the session
if (isset($_SESSION['u_name'])) {
    // The user is logged in, and we have their user_name
    $u_name = $_SESSION['u_name'];

    // Connect to your database (replace with your database credentials)
    $conn = mysqli_connect("localhost:3308", "root", "", "airio_");

    // Query the database to fetch the user's ticket information
    $query = "SELECT * FROM ticket_data_1 WHERE u_name = '$u_name';";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        // Fetch the ticket data
        while ($ticket_data = mysqli_fetch_assoc($result)) {

       
       
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <link rel="shortcut icon" href="./images/icon_image.png" />
            <style>
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }

        .ticket {
            width: 700px;
            margin: 20px auto;
            background-color: #fff;
            border: 2px solid grey;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
        }

        .ticket-header {
            background-color: grey;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 24px;
        }

        .ticket-info {
            padding: 20px;
        }

        .ticket-info table {
            width: 100%;
        }

        .ticket-info td {
            padding: 5px;
        }

        .ticket-info p {
            font-size: 16px;
        }

        .ticket-info p strong {
            font-weight: bold;
        }

        .ticket-barcode {
            text-align: center;
            padding: 10px;
        }
    </style>
        </head>
        <body>
            <div class="ticket">
                <div class="ticket-header">Flight Ticket</div>
                <div class="ticket-info">
                    <table>
                        <tr>
                            <td><strong>Book id:</strong> <?php echo $ticket_data['passenger_id']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name:</strong> <?php echo $ticket_data['name']; ?></td>
                            <td><strong>Terminal:</strong>1</td>
                        </tr>
                        <tr>
                            <td><strong>Origin:</strong> <?php echo $ticket_data['d_city']; ?></td>
                            <td><strong>Destination:</strong> <?php echo $ticket_data['destination']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Date:</strong> <?php echo $ticket_data['journey_date']; ?></td>
                            <td><strong>Time:</strong> <?php echo $ticket_data['journey_time']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Number of Seats:</strong> <?php echo $ticket_data['num_seats']; ?></td>
                            <td colspan="2"><strong>Class:</strong> <?php echo $ticket_data['class']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="ticket-barcode">
                    <div class="barcode-image">
                        <!-- Add your barcode image here -->
                        <img src="images/barcode.png" alt="Barcode">
                    </div>
                </div>
            </div>
        </body>
        </html>

        <?php
        }
        mysqli_close($conn);
    } else {
        // No ticket information found for this user
        echo "No ticket information found for this user.";
       
    }
} else {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit;
}
?>
