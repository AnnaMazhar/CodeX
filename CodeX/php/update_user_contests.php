<?php

include "connect.php";
session_start();

?>

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

        /* background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1)) */
        /* background-color: "red"; */
      }
      
        .btn-group2 button {
        position: absolute;
        right: 38px;
        top: 48px;
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

$name = $_SESSION["username"];
$ID = $_GET["c_id"];
//echo $name."! ";

// Enrollment (Insertion in participation in the DB)
$sql = "INSERT INTO participations (username, contest_ID) VALUES('$name', '$ID') ";

$result = $conn->query($sql);
if($result === TRUE){
    // Alert message upon successful enrollment
    echo '<script type="text/javascript">';
    echo 'alert("Successfully Enrolled!");';
    echo 'window.location.href = "register_into_contest.php";';
    echo '</script>';
}
else{
    echo "You are already registered. Such is life";
}

$conn->close();
?>