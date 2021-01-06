<?php
include "connect.php";
// Start session
session_start();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Register / Login</title>
    <style type="text/css">
           body { 
        /* margin: 0; */
        /* font-family: Arial, Helvetica, sans-serif; */
            font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;
          }
        .btn-group2 button {
        position: absolute;
        top: 115px;
        left: 5px;
        border: none;
        background: #404040;
        color: #ffffff !important;
        font-weight: 100;
        padding: 9px 38px;
        text-transform: uppercase;
        border-radius: 6px;
        display: inline-block;
        transition: all 0.3s ease 0s;
      }

      .btn-group2 button:hover {
        color: #404040 !important;
        font-weight: 700 !important;
        letter-spacing: 3px;
        background: none;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        transition: all 0.3s ease 0s;
      }

    </style>

<?php


if (!($_SESSION["username"]))
{
    echo "<br>Bye Thanks";
}
    else
    {   
        $username = $_SESSION['username'];
        $f_name = $_POST['first_name'];
        $l_name = $_POST["last_name"];
        $DOB = $_POST["date_of_birth"];
        $pass = $_POST["password"];

        if($f_name != ""){ $sql = "UPDATE participant SET first_name= '".$f_name."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "First Name updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating First Name: " . $conn->error;
        echo "<br>";
        } }

        if($l_name != ""){ $sql = "UPDATE participant SET last_name= '".$l_name."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Last Name updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating Last Name: " . $conn->error;
        echo "<br>";
        } }

        if($DOB != ""){ $sql = "UPDATE participant SET date_of_birth= '".$DOB."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Date of Birth updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating Date of Birth: " . $conn->error;
        echo "<br>";
        } }

        if($pass != ""){ $sql = "UPDATE participant SET password= '".$pass."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating Password: " . $conn->error;
        echo "<br>";
        } }
    }


$conn->close();

?>

</head>
<body>

    <div class="btn-group2">
    <button onclick="document.location='user_portal.php'"  style="width:25%">Return to Participant Portal</button>
  </div>
</body>
</html>
