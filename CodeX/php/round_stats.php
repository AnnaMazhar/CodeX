<?php 
include "connect.php";
session_start();

$contestid = $_SESSION['contest_ID'];
$round_num = $_POST['cid'];
$_SESSION['round_num'] = $round_num;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Contest Details</title>
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
    /* margin-top: 5em; */
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
  <a class="logo"> "<?php echo "Round ".$round_num;?>" </a>
  <div class="btn-group2">
    <button onclick="document.location='past_contests.php'"  style="width:10%">Back</button>
  </div>
</div>
<br>


<?php

// First Query to get stats overall stats
$avg_calc = "SELECT avg(marks_awarded2) as final_avg, min(marks_awarded2) as final_min, max(marks_awarded2) as final_max
            FROM (SELECT participant_username, max(marks_awarded) as marks_awarded2 FROM submission WHERE round_number = '".$round_num."'  and
            contest_ID = '".$contestid."' GROUP BY participant_username) as X";
$calcs = $conn->query($avg_calc);
$get_calcs = $calcs->fetch_row();
// ---------------------------------------------

// This query to cater to multiple submission of same participant in one round
$sql = "SELECT participant_username, max(marks_awarded) as marks_awarded FROM submission WHERE round_number = '".$round_num."'  and
          contest_ID = '".$contestid."' GROUP BY participant_username ORDER BY marks_awarded desc";          
$result = $conn->query($sql);
//----------------------------------------------

        ?>
         <table class="styled-table"><thead>
        <?php
         echo "<th>"."Participant Name"."</th>";
         echo "<th>"."Total Marks"."</th>";
         echo "<th>"."Submission"."</th>";
         
       while ($row = $result->fetch_row()) {
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> $row[1] </td>";
        ?>
        <td> <button id="<?php echo $row[0]; ?>" onclick="id_store(this.id)"  class="btn-group4"> View </button> </td>
        <?php
        }
        
      echo "</thead></table>";
      echo "<br>";
      ?>
        <table class="styled-table"><thead>
        <?php
        echo "<th>"."Mean"."</th>";
        echo "<th>"."Highest"."</th>";
        echo "<th>"."Lowest"."</th>";
        echo "<tr>";
        echo "<td> $get_calcs[0] </td>";
        echo "<td> $get_calcs[2] </td>";
        echo "<td> $get_calcs[1] </td>";

      $conn->close();
?> 

</div>
<script type="text/javascript">
  function id_store(clicked_id)
  {
    var res = clicked_id;
    var element = document.getElementById("cid");
    element.value = res;
    element.form.submit();
    
    header('Location: round_stats.php'); 
  } 

  </script>

<form action="view_user_round_subs_admin.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

</body>
</html>
