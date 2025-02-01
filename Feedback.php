<?php
$insert = false;

if (isset($_POST['name'])) {
    $servername = "localhost:3308";
    $db_username = "root";
    $db_password = "";
    $db_name = 'airio_';

    $conn = mysqli_connect($servername, $db_username, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $que_1 = $_POST['que_1'];
    $que_2 = $_POST['que_2'];  
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO `feedback` (`que_1`, `que_2`, `name`, `email`) VALUES ('$que_1', '$que_2', '$name', '$email');";

    if ($conn->query($sql) === true) {
        $insert = true;

    } else {
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
    <link rel="stylesheet" href="css/style_f.css">
    <title>Feedback</title>
</head>
<body>
<?php
if ($insert == true) {
    echo "<p class='submit-msg' style='color: white;'>Successfully submitted!</p>";
}
?>
<form class="px-2" action="feedback.php" method="post">
<div class="form-outline mb-4">
        <p><strong>How was your experience?</strong></p>
        <textarea class="form-control" id="que_1" name="que_1" rows="2" placeholder="Your Answer"></textarea>
        <p><strong>What do you think we should include to make this better experience?</strong></p>
        <textarea class="form-control" id="que_2" name="que_2" rows="6" placeholder="Your Feedback"></textarea>
    </div>
    <label for="name">Enter name:</label>
    <input class="bb" type="text" name="name" id="name" placeholder="Enter your name" required>
    <label for="email"><br>Enter e-mail</label>
    <input class="bb" type="email" name="email" id="email" placeholder="Enter your email" required>
    <div class="card-footer text-end">
    <button class="btn"><a href="index.html" style="text-decoration: none; color: white; font-size: 15px;">Back</a></button>
        <button type="submit" class="btn">Submit</button>
    </div>
</form>
</body>
</html>
