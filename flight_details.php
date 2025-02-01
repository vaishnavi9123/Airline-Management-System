<?php
$insert = false;
if(isset($_POST['seats'])){
$servername = "localhost:3308";
$db_username = "root";
$db_password = "";
$db_name = 'airio_';

$conn = mysqli_connect($servername, $db_username, $db_password,$db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$d_city=$_POST['d_city'];
$a_city=$_POST['a_city'];
$seats=$_POST['seats'];
$d_time=$_POST['d_time'];
$a_time=$_POST['a_time'];
$airport_name=$_POST['airport_name'];
$airport_address=$_POST['airport_address'];
$first_class_cost=$_POST['first_class_cost'];
$business_class_cost=$_POST['business_class_cost'];
$pre_economy_class_cost=$_POST['pre_economy_class_cost'];
$economy_class_cost=$_POST['economy_class_cost'];

$sql = "INSERT INTO `flight_details` (`d_city`, `a_city`, `seats`, `d_time`, `a_time`, `airport_name`, `airport_address`, `first_class_cost`, `business_class_cost`, `pre_economy_class_cost`, `economy_class_cost`) VALUES ('$d_city', '$a_city', '$seats', '$d_time', '$a_time', '$airport_name', '$airport_address', '$first_class_cost', '$business_class_cost', '$pre_economy_class_cost', '$economy_class_cost');";
   if ($conn->query($sql) === true) {
        $insert = true;
    } else {
        echo "ERROR: $sql<br> $conn->error";
    }
$conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/icon_image.png" />
    <title>Add Flight</title>
    <link rel="stylesheet" href="css/style_fli_d.css">
</head>
<body>
 <button><a href="admin_h.html" style="text-decoration: none; color: black; border-radius: 6px;">Back</a></button>   
    <img class="reg" src="images/flight_details.png" alt="flight_details">
    <div class="container">
    <h1>Add Flight</h1>
    <?php
    if($insert==true){
    echo "<p class='submit-msg'>Successfully Added!</p>";
    }
    ?>
    <form action="" method="post">
    <label class="form_" for="form2">From:</label><br>
        <input type="text" name="d_city" id="d_city" placeholder="City" required><br>
        <label class="form_" for="form2">To:</label><br>
        <input type="text" name="a_city" id="a_city" placeholder="City" required><br>
        <label class="form_" for="form2">Seats:</label><br>
        <input type="number" name="seats" id="seats" placeholder="Number of seats" required><br>
        <label class="form_" for="form2">Departure Time:</label><br>
        <input type="time" name="d_time" id="d_time" placeholder="Departure Time" required><br>
        <label class="form_" for="form2">Arrival Time:</label><br>
        <input type="time" name="a_time" id="a_time" placeholder="Arrival Time" required><br>
        <label class="form_" for="form2">Airport name:</label><br>
        <input type="text" name="airport_name" id="airport_name" placeholder="Enter the name of the airport" required><br>
        <label class="form_" for="form2">Airport address:</label><br>
        <input type="text" name="airport_address" id="airport_address" placeholder="Enter address of the airport" required><br>
        <label class="form_" for="form2">Price of first class ticket:</label><br>
        <input type="number" name="first_class_cost" id="first_class_cost" placeholder="Enter cost of one seat" required><br>
        <label class="form_" for="form2">Price of business class ticket:</label><br>
        <input type="number" name="business_class_cost" id="business_class_cost" placeholder="Enter cost of one seat" required><br>
        <label class="form_" for="form2">Price of premium economy class ticket:</label><br>
        <input type="number" name="pre_economy_class_cost" id="pre_economy_class_cost" placeholder="Enter cost of one seat" required><br>
        <label class="form_" for="form2">Price of economy class ticket:</label><br>
        <input type="number" name="economy_class_cost" id="economy_class_cost" placeholder="Enter cost of one seat" required><br>
        <button type="submit" class="btn" style="width: 70px;">Add</button>
    </form>
    </div>
</body>
</html>