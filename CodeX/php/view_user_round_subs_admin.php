<?php

include "connect.php";
include "fetch_name.php";
include "connect.php";

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My Contests</title>
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

      table{
      margin-left:auto; 
      margin-right:auto;
      margin-top:auto;
      
      top: 20%;
      border: 1px solid black;
      
      width: 75%;
      background-color: #E6E1E0; 
    }

    th, td {
      height: 5px;
      padding: 10px;
    }
    th:hover
        {
            background-color: #999;
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
</head>

<body>
    <?php 
    $contestid = $_SESSION['contest_ID'];
  $round_num = $_SESSION['round_num'];
  $name = $_POST["cid"];

    ?> 
    <div class="header">
    <a class="logo"> Submission</a>
    <div class="btn-group2">
    <button onclick="document.location='past_contests.php'"  style="width:10%">Back</button>
    </div>
    </div>

    <div>
          <?php 
          $sql = "SELECT max(marks_awarded) as marks_awarded FROM submission WHERE round_number = '".$round_num."'  and
          contest_ID = '".$contestid."' and participant_username = '".$name."' ";
          $result = $conn->query($sql);
          $row = $result->fetch_row();
          $max_marks = $row[0];

          $sql = "SELECT submitted_code FROM submission WHERE round_number = '".$round_num."'  and
          contest_ID = '".$contestid."' and participant_username = '".$name."' and marks_awarded = '".$max_marks."'  ";
          $result = $conn->query($sql);
          $row = $result->fetch_row();
          $code = $row[0];          
        
        echo "<br>";  
        echo "<table>";
        echo "<th>"."Code Submitted by $name (Round $round_num)"."</th>";
        echo "<tr>";
        echo "<td>";
        echo  "<pre>";
        echo ($code);
        echo "</pre>";
        echo "</td>";  
        echo "</tr>";
        echo "</table>";

        $sql1 = "SELECT total_marks FROM round WHERE round_number=$round_num AND contest_ID=$contestid";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        $total_marks = $row1['total_marks'];
        ?>
        <table>
        <th>
        <?php echo "Marks Awarded: ";
        echo ($max_marks);
        echo " / ";
        echo $total_marks;
        ?>
        </th>
        </table>

         <?php
              $conn->close()
          ?>
    </table>
    </div>

    
</body>
</html>