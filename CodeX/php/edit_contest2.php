<?php
include "connect.php";
session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Edit Contest</title>
    <style type="text/css">
        body { 
        margin: 0;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;
      }

      .header {
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 40px 10px;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
      }

      .header a {
        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px; 
        line-height: 25px;
        border-radius: 4px;
      }
      .header a.logo {
        font-size: 35px;
        font-weight: 100;
        text-transform: uppercase;

      }

      .btn-group2 button {
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
<head>
<body>
<div>
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
        $contestid = $_SESSION['contest_ID'];
        $name = $_POST['name'];
        $starttime = $_POST["start_time"];
        $duration = $_POST["duration"];
        $time_curr = date("Y-m-d H:i:s");

        $sql = "SELECT time_created from contest WHERE contest_ID='".$contestid."' ";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $creation = $row[0];

        if($starttime !=""){
            if(strtotime($starttime) < strtotime($time_curr) or strtotime($starttime) < strtotime($creation) ) {
              echo '<script type="text/javascript">'; 
              echo 'alert("Start time can not be earlier than Create/Current time");'; 
              echo 'window.location.href = "contest_details.php";';
              echo '</script>';
            }
            else{
                $sql = "UPDATE contest SET start_time= '".$starttime."' WHERE contest_ID='".$contestid."' ";
                if ($conn->query($sql) === TRUE) {
                echo "Start Time Updated Successfully!";
                echo "<br>";
                } else {
                echo "Error updating starting time: " . $conn->error;
                echo "<br>";
                }
            }
        }

        if($duration!=""){
            if($duration <= 0){
              echo '<script type="text/javascript">'; 
              echo 'alert("Contest duration should be greater than 0 minutes");'; 
              echo 'window.location.href = "contest_details.php";';
              echo '</script>';
            }
            else{
                $sql = "UPDATE contest SET duration= '".$duration."'  WHERE contest_ID='".$contestid."' ";
                if ($conn->query($sql) === TRUE) {
                echo "Contest Duration Updated Successfully!";
                echo "<br>";
                } else {
                echo "Error updating duration: " . $conn->error;
                echo "<br>";
                }
            }
        }
        
        if($name != ""){ $sql = "UPDATE contest SET name= '".$name."' WHERE contest_ID='".$contestid."' ";
        if ($conn->query($sql) === TRUE) {
        echo '<script type="text/javascript">'; 
        echo 'alert("All changes made Successfully");'; 
        echo 'window.location.href = "contest_details.php";';
        echo '</script>';
        } else {
        echo "Error updating contest name: " . $conn->error;
        echo "<br>";
        } }
      
        if($name == "" && $duration =="" && $starttime =="")  
        {
          echo '<script type="text/javascript">'; 
          echo 'alert("No changes to make here");'; 
          echo 'window.location.href = "contest_details.php";';
          echo '</script>';          
        }
    }
}
$conn->close();

?>

</div>
</body>

<body>
    
    <div class="btn-group2">
    <button onclick="document.location='contest_details.php'"  style="width:10%">Back</button>
    </div>
</body>
</html>
