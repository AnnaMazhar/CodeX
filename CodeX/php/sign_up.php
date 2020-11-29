<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Register / Login</title>
    <style type="text/css">
        body{
        background-color: rgb(99,128,107)
        }
        .btn-group button {
      position: absolute;
      top: 65px;
      left: 15px;
      background-color: #11346b; 
      border: 1px solid green; /* Green border */
      color: white; /* White text */
      padding: 10px 24px; /* Some padding */
      cursor: pointer; /* Pointer/hand icon */
      float: left; /* Float the buttons side by side */
    }
        .btn-group button:hover {
      background-color: #3e8e41;
    }

    </style>

<?php

$servername = "localhost";
$username = "debian-sys-maint";
$password = "NVxKE4bCYGO8nV9Y";
$dbname = "Code-X";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "Code-X";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$uname = $_POST['username'];
$pass = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$DOB =  $_POST['date_of_birth'];
$org = $_POST['organization'];
$type = $_POST['type'];
  
if($type === "participant")
{
    $sql = "INSERT INTO participant (username, password, first_name, last_name, email,date_of_birth, gender) VALUES ('$uname', '$pass', '$fname', '$lname', '$email', '$DOB', '$gender')";
} else {
    $sql = "INSERT INTO admin (username, password, first_name, last_name, organization, email,date_of_birth, gender) VALUES ('$uname', '$pass', '$fname', '$lname', '$org', '$email', '$DOB', '$gender')";
}

if ($conn->query($sql) === TRUE) {

    echo "<h2> Thanks for registering. You are now our valued member! </h2>"; 
    
    session_start();
    $_SESSION["username"] = $uname;
    if ($type === "participant")
    {
        $_SESSION["is_admin"] = False;
        //header('Location: ../../test.html'); exit;
    }
    else
    {
        $_SESSION["is_admin"] = True;
        //header('Location: ../../test.html'); exit;
    }
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?> 

</head>
<body>

    <div class="btn-group">
    <button onclick="document.location='../html/index.html'"  style="width:25%">Return to Login Page</button>
  </div>
</body>
</html>
