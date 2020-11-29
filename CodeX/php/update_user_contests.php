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
include "connect.php";


session_start();

$name = $_SESSION["username"];
$ID = $_GET["c_id"];
echo $name."! ";

$sql = "INSERT INTO participations (username, contest_ID) VALUES('$name', '$ID') ";

$result = $conn->query($sql);
if($result === TRUE){
    echo "You are successfully registered! Congratulations!";
}
else{
    echo "You are already registered. Such is life";
}



$conn->close();
?>

</head>
<body>

    <div class="btn-group">
    <button onclick="document.location='user_portal.php'"  style="width:25%">Return to Participant Portal</button>
  </div>
</body>
</html>