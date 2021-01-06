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
        margin: 0;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;
      }
      .btn-group button {
        position: absolute;
        right: 38px;
        top: 40px;
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

      .btn-group button:hover {
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
        $username = $_SESSION['username'];
        $f_name = $_POST['first_name'];
        $l_name = $_POST["last_name"];
        $DOB = $_POST["date_of_birth"];
        $org = $_POST["organization"];
        $pass = $_POST["password"];

        if($f_name != ""){ $sql = "UPDATE admin SET first_name= '".$f_name."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "First Name updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating First Name: " . $conn->error;
        echo "<br>";
        } }

        if($l_name != ""){ $sql = "UPDATE admin SET last_name= '".$l_name."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Last Name updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating Last Name: " . $conn->error;
        echo "<br>";
        } }

        if($DOB != ""){ $sql = "UPDATE admin SET date_of_birth= '".$DOB."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Date of Birth updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating Date of Birth: " . $conn->error;
        echo "<br>";
        } }

        if($org != ""){ $sql = "UPDATE admin SET organization = '".$org."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Organization updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating Organization: " . $conn->error;
        echo "<br>";
        } }

        if($pass != ""){ $sql = "UPDATE admin SET password= '".$pass."' WHERE username='".$username."' ";
        if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully...";
        echo "<br>";
        } else {
        echo "Error updating Password: " . $conn->error;
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
