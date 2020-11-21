<?php

$servername = "localhost";
$username = "debian-sys-maint";
$password = "NVxKE4bCYGO8nV9Y";
$dbname = "Code-X";

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

    echo "Thanks for registering. You are now our valued member!";
    
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
