<?php
$insert = false;
if(isset($_POST['name'])){
$servername = "localhost:3308";
$db_username = "root";
$db_password = "";
$db_name = 'airio_';

$conn = mysqli_connect($servername, $db_username, $db_password,$db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
                $name = $_POST["name"];
                $dob = $_POST["dob"];
                $contact_no =$_POST["contact_no"];
                $email = $_POST["email"];
                $type = $_POST["type"];
                $salary = $_POST["salary"];

$sql= "INSERT INTO `employees` (`name`, `dob`, `contact_no`, `email`, `type`, `salary`) VALUES ('$name', '$dob', '$contact_no', '$email', '$type', '$salary');";

     if($conn->query($sql)== true){
       $insert= true;
     }
     else{
        echo "ERROR: $sql <br> $conn->error";
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
    <title>Add Employee</title>
    <link rel="stylesheet" href="css/style_fli_d.css">
</head>
<body>
 <button><a href="employees.php">Back</a></button>   
    <img class="reg" src="images/flight_details.png" alt="flight_details">
    <div class="container">
    <h1>Add Employee</h1>
    <?php
    if($insert==true){
    echo "<p class='submit-msg'>Successfully Added!</p>";
    }
    ?>
    <form action="" method="post">
    <label class="form_" for="form2">Enter name:</label><br>
        <input type="text" name="name" id="name" placeholder="Name of employee" required><br>
        <label class="form_" for="form2">Enter Date Of Birth:</label><br>
        <input type="text" name="dob" id="dob" placeholder="DOB" required><br>
        <label class="form_" for="form2">Enter Contact Number:</label><br>
        <input type="number" name="contact_no" id="contact_no" placeholder="Mobile no." required><br>
        <label class="form_" for="form2">Enter Email:</label><br>
        <input type="email" name="email" id="email" placeholder="email" required><br>
        <label class="form_" for="type">Select Employee Type:</label><br>
      <select id="type" name="type" style="width: 310px;" required>
      <option value=""> </option>
        <option value="Pilot">Pilot</option>
        <option value="Hostess">Hostess</option>
        <option value="Worker">Worker</option>
      </select><br>
      <label class="form_" for="form2">Enter Emplyee Salary:</label><br>
        <input type="number" name="salary" id="salary" placeholder="Salary" required><br>
        <button type="submit" class="btn" style="width: 70px;">Add</button>
    </form>
    </div>
</body>
</html>