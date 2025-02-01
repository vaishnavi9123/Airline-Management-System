<?php
$insert = false;

$servername = "localhost:3308";
$db_username = "root";
$db_password = "";
$db_name = 'airio_';

$conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $flight_id = $_POST['flight_id'];
  $destination = $_POST['destination'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $no_seats = $_POST['no_seats'];
  $class = $_POST['class'];

  $sql = "INSERT INTO `booking` (`name`, `flight_id`, `destination`, `journey_date`, `journey_time`, `num_seats`, `class`) VALUES 
          ('$name', '$flight_id', '$destination', '$date', '$time', '$no_seats', '$class');";

  if ($conn->query($sql) === true) {
    $insert = true;
  } else {
    echo "ERROR: " . $sql . "<br>" . $conn->error;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./images/icon_image.png" />
  <link rel="stylesheet" href="css/style_b.css">
  <title>Flight Booking</title>
</head>

<body>
  <img class="log" src="images/book.jpg" alt="booking">
  <div class="container">
    <button class="btn"><a href="passenger_h.html" style="text-decoration: none; color: black">Back</a></button>
    <h1>Flight Booking</h1>
    <?php
    if ($insert == true) {
      echo "<p class='submit-msg'>Successfully booked!</p>";
    }
    ?>
    <form action="" method="post">
    <label class="form_" for="name">Enter name:</label><br> 
    <input type="text" name="name" id="name" placeholder="Name" required><br>
    <label class="form_" for="flight_id">From:</label><br>
      <select id="flight_id" name="flight_id" required>
      <option value="">Select Origin</option>
        <?php
        $sql = "SELECT flight_id, d_city FROM flight_details;";
        $result = mysqli_query($conn, $sql);

        // Populate the dropdown menu with options
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["flight_id"] . '">' . $row["flight_id"] . '-' . $row["d_city"] . '</option>';
          }
        }
        ?>
      </select><br>
   
      <label class="form_" for="destination">To:</label><br>
      <select id="destination" name="destination" required>
      <option value="">Select Destination</option>
        <?php

        $sql = "SELECT flight_id, a_city FROM flight_details;";
        $result = mysqli_query($conn, $sql);

        // Populate the dropdown menu with options (same code as above)
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["a_city"] . '">' . $row["a_city"] . '</option>';
          }
        }
        ?>
      </select><br>

      <label class="form_" for="date">Date:</label><br>
      <input type="date" id="date" name="date" required><br>

      <label class="form_" for="time">Time:</label><br>
      <select id="time" name="time" required>
      <option value="">Select Time</option>
        <?php

        $sql = "SELECT flight_id, d_time FROM flight_details;";
        $result = mysqli_query($conn, $sql);

        // Populate the dropdown menu with options (same code as above)
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["d_time"] . '">' . $row["d_time"] . '</option>';
          }
        }

        ?>
      </select><br>

      <label class="form_" for="no_seats">Number of seats:</label><br>
      <input type="number" id="no_seats" name="no_seats" required max="200"><br>

      <label class="form_" for="class">Select Flight Class:</label><br>
      <select id="class" name="class" required>
      <option value="">Select Class</option>
        <option value="Economy">Economy Class</option>
        <option value="Premium Economy">Premium Economy Class</option>
        <option value="Business">Business Class</option>
        <option value="First Class">First Class</option>
      </select><br>
      <button type="submit" class="btn">Book</button>
    </form>
  </div>
  <?php
  $conn->close();
  ?>

  
</body>

</html>
