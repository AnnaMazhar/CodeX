<?php
include "connect.php";
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Register / Login</title>
    <style type="text/css">
        body{
        background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1));
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

        if(strtotime($start_time) < strtotime($time_created)){ // Error in start time
          echo '<script type="text/javascript">'; 
          echo 'alert("Start time can not be earlier than Create time");'; 
          echo 'window.location.href = "../html/add-contest.html";';
          echo '</script>';
         }
        elseif($duration <= 0){
          echo '<script type="text/javascript">'; 
          echo 'alert("Contest Duration should be greater than 0 minutes");'; 
          echo 'window.location.href = "../html/add-contest.html";';
          echo '</script>';
        } 

        else { 
        $sql = "INSERT INTO contest (name, admin_username, time_created, start_time, duration) VALUES ('$name', '$admin_username', '$time_created', '$start_time', '$duration')";
    
        if ($conn->query($sql) === TRUE) {
            echo '<script type="text/javascript">'; 
            echo 'alert("New contest has been successfully created");'; 
            echo 'window.location.href = "admin_portal.php";';
            echo '</script>';  
        } 
        else {
            echo '<script type="text/javascript">'; 
            echo 'alert("An error occured while contest creation");'; 
            echo 'window.location.href = "../html/add-contest.html";';
            echo '</script>'; }

      }
    }
}

$conn->close();

?> 
</head>
<body>

</body>
</html>
