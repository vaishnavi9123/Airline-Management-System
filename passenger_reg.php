<?php
$insert = false;
if(isset($_POST['u_name'])){
$servername = "localhost:3308";
$db_username = "root";
$db_password = "";
$db_name = 'airio_';

$conn = mysqli_connect($servername, $db_username, $db_password,$db_name);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "sucess connecting to the db";

$u_name=$_POST['u_name'];
$u_password=$_POST['u_password'];
$dob=$_POST['dob'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$contact_no=$_POST['contact_no'];
$email=$_POST['email'];
$sql= "INSERT INTO `passenger_reg` (`u_name`, `u_password`, `dob`, `dob`, `age`, `gender`, `contact_no`, `email`) VALUES ('$u_name', '$u_password', '$dob', '$dob', '$age', '$gender', '$contact_no', '$email');";

     if($conn->query($sql)== true){
       // echo "Successfully registered";
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
    <link rel="stylesheet" href="css/style.css">
    <title>Passenger Register</title>
</head>
<body>
    <img class="reg" src="images/passenger_reg.jpg" alt="passenger_reg">
    <div class="container">
    <h1>Passenger detail</h1>
    <?php
    if($insert==true){
    echo "<p class='submit-msg'>Successfully registered!</p>";
    }
    ?>
    <form action="" method="post">
        <label class="form_" for="form2">User_name:</label>
        <input type="text" name="u_name" id="u_name" placeholder="Enter user_name" required>
        <label class="form_" for="form2">Password:</label>
        <input type="text" name="u_password" id="u_password" placeholder="Enter password" required>
        <label class="form_" for="form2">Date Of Birth:</label>
        <input type="date" name="dob" id="dob">
        <label class="form_" for="form2">Age:</label>
        <input type="text" name="age" id="age" placeholder="Enter your age">
        <label class="form_" for="form2">Gender:</label>
        <input type="text" name="gender" id="gender" placeholder="Enter gender(F/M)">
        <label class="form_" for="form2">Contact number:</label>
        <input type="number" name="contact_no" id="contact_no" placeholder="Enter your contact number">
        <label class="form_" for="form2">E-mail:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email">
        <button class="btn"><a href="login.php" style="text-decoration: none; color: black;">Back</a></button>
        <button type="submit" class="btn">Submit</button>
    </form>
    </div>
        </body>
        </html>
        