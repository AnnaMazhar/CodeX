<?php
include "connect.php";
session_start();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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

      .btn-group2 button {
        position: absolute;
        right: 38px;
        top: 20px;
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

      .btn-group3 button {
        position: absolute;
        right: 38px;
        top: 65px;
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

      .btn-group3 button:hover {
        color: #404040 !important;
        font-weight: 700 !important;
        letter-spacing: 3px;
        background: none;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        transition: all 0.3s ease 0s;
      }

      /*  */

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

<!-- <form action="my_stats.php" method="post">
<input type="hidden" name="cid" id="cid">
</form> -->

  <?php

        // Get Contest ID through POST
        $contestid = $_GET['c_id'];
        $uname = $_SESSION["username"];

        // Set Session Variable
        $_SESSION['contest_ID'] = $contestid;

        $sql = "SELECT name FROM contest WHERE contest_ID='".$contestid."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['name'];

        $sql_2 = "SELECT max(round_number) AS max_round_number FROM round WHERE contest_ID = '".$contestid."'";
        $resultt = $conn->query($sql_2);
        $row_two = $resultt->fetch_assoc();
        $num_rounds = $row_two["max_round_number"]; // Now i have the number of rounds

?> 

 <div class="header">
  <a class="logo"> <?php echo "Contest Statistics-".$name ?> </a>
  <div class="btn-group2">
    <button onclick="document.location='user_display_contests.php'"  style="width:15%">Back</button>
  </div>
</div>
<br>


<div class="btn-group3">
    <button id= "<?php echo $contestid; ?>" onclick="id_store2(this.id)"  style="width:15%">My Performance</button>
</div>
<?php


// To get stats
$calc_stats = "SELECT avg(total_marks) as final_avg, min(total_marks) as final_min, max(total_marks) as final_max
FROM (SELECT participant_username,  SUM(marks_awarded2) as total_marks
FROM (SELECT participant_username, max(marks_awarded) as marks_awarded2 FROM submission WHERE contest_ID = '".$contestid."' GROUP BY round_number, participant_username) as X
GROUP BY participant_username) as Y";
$stats = $conn->query($calc_stats);
$get_stats = $stats->fetch_row();

// To calculate Each users marks
$sql = "SELECT SUM(marks_awarded2) as total_marks, participant_username
        FROM (SELECT participant_username, max(marks_awarded) as marks_awarded2 FROM submission WHERE contest_ID = '".$contestid."' GROUP BY round_number, participant_username) as X
        GROUP BY participant_username ORDER BY total_marks DESC";
$result = $conn->query($sql);

        $result = $conn->query($sql);
        ?>
        <table class="styled-table"><thead>
        <?php
        echo "<th>"."Participant Name"."</th>";
        echo "<th>"."Total Marks"."</th>";
   
        while ($row = $result->fetch_row()) {
        echo "<tr>";
        echo "<td> $row[1] </td>";
        echo "<td> $row[0] </td>";
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
        echo "<td> $get_stats[0] </td>";
        echo "<td> $get_stats[2] </td>";
        echo "<td> $get_stats[1] </td>";
      echo "<br>";
      echo "</thead></table>";
      echo "<br>";


    for($i = 1; $i <= $num_rounds; $i++){
      ?>
        <table class="styled-table"><thead>
        <tr>
        <td> Round <?php echo $i; ?> </td>
        <td><div class="btn-group4">
        <button id= "<?php echo $i; ?>" onclick="id_store(this.id)" > View Stats</button>
        </div></td>
        </tr>
        <?php
        echo "</thead></table>";
    }

?> 

</div>
<script type="text/javascript">
  function id_store(clicked_id)
  {
    var res = parseInt(clicked_id);
    var element = document.getElementById("cid");
    element.value = res;
    element.form.submit();
    
    header('Location: round_stats_user.php'); 
  } 

  function id_store2(clicked_id)
  {
    var res = parseInt(clicked_id);
    var element = document.getElementById("cid2");
    element.value = res;
    element.form.submit();
    
    header('Location: my_stats.php'); 
  } 
  </script>

<form action="my_stats.php?c_id=<?php echo $contestid ?>&prev=past_contests_user" method="post"> <!-- MODIFIED LINE -->
<input type="hidden" name="cid2" id="cid2">
</form>

<form action="round_stats_user.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

</body>
</html>