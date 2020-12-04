<?php
include "connect.php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Contest Details</title>
    <style type="text/css">
        body{
        background-color: rgb(99,128,107)
        }
        fieldset
        {        
          position: absolute;
          top: 140px;
          right: 500px;
          width: 10em
        }
        legend{
        margin-left: auto;
        margin-right: auto;
        }
        .header {
          overflow: hidden;
          background-color: #f1f1f1;
          padding: 30px 10px;
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
          font-size: 30px;
          font-weight: bold;
          
        }
        .form
        {
            background-color: grey;
            color: white;
        margin-top: 0px;
        }

        .rounds-table table{
          align: center;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        
        .rounds-table thead tr {
        background-color: grey;
        color: black;
        text-align: center;
        border: 1px solid black;
        }

        .rounds-table th, .rounds-table td {
          height: 5px;
          padding: 10px;
        }

        .styled-table {
            border-collapse: collapse;
            margin-left:30px; 
            margin-top:auto;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
        background-color: grey;
        color: black;
        text-align: center;
        border: 1px solid black;
        }

        .styled-table th,
        .styled-table td {
        padding: 12px 15px;
        }

        .styled-table2 {
            border-collapse: collapse;
            margin-left:80px; 
            margin-top:auto;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table2 thead tr {
        background-color: grey;
        color: black;
        text-align: center;
        border: 1px solid black;
        }

        .styled-table2 th,
        .styled-table2 td {
        padding: 12px 15px;
        }

        .btn-group button {
        position: absolute;
        top: 45px;
        right: 17px;
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

    .btn-group button {
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group-edit button {
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group-delete button {
  background-color: #e74c3c; 
  border: 1px solid red; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group2 button {
  position: absolute;
  top: 20px;
  right: 15px;
  background-color: #11346b; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group2 button:hover {
  background-color: #0E5225;
}

.btn-group3 button {
  position: absolute;
  top: 60px;
  right: 15px;
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group3 button:hover {
  background-color: #11346b;
}
.btn-group4 button {
  margin: auto;
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

            
    </style>
</head>
<body>

<!-- <form action="my_stats.php" method="post">
<input type="hidden" name="cid" id="cid">
</form> -->

  <?php

        // Get Contest ID through POST
        $contestid = $_POST['cid'];

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
    <button onclick="document.location='past_contests_user.php'"  style="width:15%">Back</button>
  </div>
</div>
<br>

<div class="btn-group3">
    <button id=$contestid onclick="id_store2(this.id)"  style="width:15%">My Performance</button>
</div>

<?php

$sum = 0;
$count = 0;
$lowest =10000; 
$highest = 0;
$avg = 0;

$sql = "SELECT sum(marks_awarded) AS summ, participant_username FROM submission WHERE contest_ID='".$contestid."' GROUP BY participant_username";
        $result = $conn->query($sql);
        echo<<<HTML
        <table class="styled-table"><thead>
        HTML;
        echo "<th>"."Participant Name"."</th>";
        echo "<th>"."Total Marks"."</th>";
   
        while ($row = $result->fetch_row()) {
        echo "<tr>";
        echo "<td> $row[1] </td>";
        echo "<td> $row[0] </td>";
        $sum = $sum + $row[0];
        $count = $count + 1;
        if($row[0] < $lowest){
          $lowest = $row[0];
        }
        if($row[0]> $highest){
          $highest = $row[0];
        }
      }

      if($count!=0)
        {$avg = $sum/$count;}

      echo "</thead></table>";
      echo "<br>";
      echo<<<HTML
        <table class="styled-table"><thead>
        HTML;

        echo "<th>"."Mean"."</th>";
        echo "<th>"."Highest"."</th>";
        echo "<th>"."Lowest"."</th>";
        echo "<tr>";
        echo "<th> $avg </th>";
        echo "<th> $highest </th>";
        echo "<th> $lowest </th>";
      echo "<br>";
      echo "</thead></table>";
      echo "<br>";


    for($i = 1; $i <= $num_rounds; $i++){
      echo<<<HTML
        <table class="styled-table"><thead>
        <tr>
        <th> Round $i </th>
        <td><div class="btn-group4">
        <button id=$i onclick="id_store(this.id)"  style="width:60%"> View Stats</button>
        </div></td>
        </tr>
        HTML;
        echo "</thead></table>";
    }

?> 

</div>
<script type="text/javascript">
  function id_store(clicked_id)
  {
    var res = clicked_id;
    var element = document.getElementById("cid");
    element.value = res;
    element.form.submit();
    
    header('Location: round_stats_user.php'); 
  } 

  function id_store2(clicked_id)
  {
    var res = clicked_id;
    var element = document.getElementById("cid2");
    element.value = res;
    element.form.submit();
    
    header('Location: my_stats.php'); 
  } 
  </script>

<form action="my_stats.php" method="post">
<input type="hidden" name="cid2" id="cid2">
</form>

<form action="round_stats_user.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

</body>
</html>
