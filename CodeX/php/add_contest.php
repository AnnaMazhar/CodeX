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

// Start session
session_start();

// If session doesnt have relevant variables
if (!(isset($_SESSION["username"]) && isset($_SESSION["is_admin"])))
{
    echo "Yeh kya baat hui yaar :( Aap kidhar?";
}
else
{
    if (!($_SESSION["is_admin"]))
    {
        echo $_SESSION["is_admin"];
        echo "<br>Yaar mujhe tou lagta hai aap admin hi nahi ho :(";
    }
    else
    {
        date_default_timezone_set("Asia/Karachi");
        $name = $_POST['name'];
        $admin_username = $_SESSION["username"];
        $time_created = date("Y-m-d H:i:s"); // seconds bhi add kar ke dekho
        $start_time = $_POST['start_time'];
        $duration = $_POST['duration'];
    
        $sql = "INSERT INTO contest (name, admin_username, time_created, start_time, duration) VALUES ('$name', '$admin_username', '$time_created', '$start_time', '$duration')";
    
        if ($conn->query($sql) === TRUE) {
    
            echo "<h1> New Contest has been successfully created! </h>";
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

?> 
</head>
<body>

    <div class="btn-group">
    <button onclick="document.location='admin_portal.php'"  style="width:25%">Return to Admin Portal</button>
  </div>
</body>
</html>
