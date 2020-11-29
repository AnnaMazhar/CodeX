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
      top: 115px;
      left: 5px;
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
        
        $contestid = $_SESSION['contest_ID'];
        $name = $_POST['name'];
        $starttime = $_POST["start_time"];
        $duration = $_POST["duration"];
        
        if($name != ""){ $sql = "UPDATE contest SET name= '".$name."' WHERE contest_ID='".$contestid."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Contest Name Updated Successfully!";
        echo "<br>";
        } else {
        echo "Error updating contest name: " . $conn->error;
        echo "<br>";
        } }

        if($starttime != ""){ $sql = "UPDATE contest SET start_time= '".$starttime."' WHERE contest_ID='".$contestid."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Start Time Updated Successfully!";
        echo "<br>";
        } else {
        echo "Error updating starting time: " . $conn->error;
        echo "<br>";
        } }

        if($duration != ""){ $sql = "UPDATE contest SET duration= '".$duration."'  WHERE contest_ID='".$contestid."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Contest Duration Updated Successfully!";
        echo "<br>";
        } else {
        echo "Error updating duration: " . $conn->error;
        echo "<br>";
        } }
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
