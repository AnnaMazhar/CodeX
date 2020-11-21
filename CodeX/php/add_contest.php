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
    
            echo "Woahh! New Contest Made";
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

?> 
