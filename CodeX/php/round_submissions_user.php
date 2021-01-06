<?php

include "connect.php";

// Start session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Participant Submissions</title>
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
      .header b {
        position: absolute;;
        top: 10px;
        right: 25px;
        color: black;
        text-align: center;
        padding: 20px;
        text-decoration: none;
        font-size: 18px; 
        line-height: 25px;
        border-radius: 4px;
      }

      .header b.logo {
        font-size: 18px;
        font-weight: 100;
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


          tr, td, th
    {
        border-style: groove;
        border-width: 0cm;
        color: rgba(0, 0, 0, 0.705);
        /* border-color: rgba(158, 94, 105, 0.4); */
        background-color: rgba(64, 65, 66, 0.1);
        padding: 10px 20px;
        text-align: center;
        transition: background-color 2s, border-radius 2s;
    }

    table
    {
        margin-top: 5em;
        margin-left: auto;
        margin-right: auto;
    }


    th
    {
        color: white;
        border-top-left-radius: 0.3cm;
        border-top-right-radius: 0.3cm;
        border-bottom-width: 0.1cm;
        text-transform: uppercase;
        border-color: #000000;
        background-color:#333;
    }
    </style>
</head>


<body>
<div class="header">
<a class="logo"> Round Submissions </a>
<div class="btn-group2">
  <button onclick="back()">Back</button>
  </div>
</div>
<br>
<?php
  $contestid = $_SESSION['contest_ID'];
  $round = $_POST["cid"];
  $uname = $_SESSION["username"];

  $sql = "SELECT * FROM submission WHERE participant_username='".$uname."' and contest_ID='".$contestid."' and round_number='".$round."'
    ORDER BY time_stamp";
  $result = $conn->query($sql);
  echo "<table class=center> ";
  echo "<th>"."Round Number"."</th>";
  echo "<th>"."Time Stamp"."</th>";
  echo "<th>"."Interpretor Result"."</th>";
  echo "<th>"."Marks Awarded"."</th>";
  echo "<th>"."Submitted Code"."</th>";

  while ($row = $result->fetch_row()) {
  echo "<tr>";
    for($i = 0; $i < $result->field_count; $i++){
    if ($i != 0 && $i != 3 && $i != 4)
      echo "<td>$row[$i]</td>";
  }
  $c_id = $row[0];
  $r_no = $row[1];
  $time = ($row[2]);
 
  // Send values to view and grade
  $loc = "display_submissions.php?c_id=".$c_id."&r_no=".$r_no."&time=".$time."&pname=".$uname;
  $click = "document.location = '".$loc."'";
  echo '<td><button onclick = "'.$click.'" class="button button1">View</button></td>';
}
echo "</table>";        

$conn->close();

?>
  <script>
  function back()
  {
    window.location.href = "past_contests_user.php";
  }
  
  </script>

</body>
</html>
  


