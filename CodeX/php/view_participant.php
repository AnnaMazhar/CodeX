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


if (!($_SESSION["username"]))
{
    #echo $_SESSION["is_admin"];
    echo "<br>Bye Thanks";
}
else
{
    $name = $_POST['name'];
    $participant_username = $_SESSION["username"];
    # Connect HTML
}


$conn->close();

?> 
