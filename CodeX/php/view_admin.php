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


if (!($_SESSION["is_admin"]))
{
    #echo $_SESSION["is_admin"];
    echo "<br>Bye Thanks";
}
else
{
    $name = $_POST['name'];
    $admin_username = $_SESSION["username"];

    
}


$conn->close();

?> 
