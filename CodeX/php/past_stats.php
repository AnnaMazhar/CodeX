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
        body{
  background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1))
        
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
      font-family: Arial, Helvetica,sans-serif;
      font-size: 25px;
      
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
  top: 50px;
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
  top: 200px;
  right: 15px;
  background-color: #11346b; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group3 button:hover {
  background-color: #0E5225;
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

<form action="round_stats.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

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
    <button onclick="document.location='past_contests.php'"  style="width:10%">Back</button>
  </div>
</div>
<br>

  <script type="text/javascript">
  function id_store(clicked_id)
  {
    var res = parseInt(clicked_id);
    var element = document.getElementById("cid");
    element.value = res;
    element.form.submit();
    
    header('Location: round_stats.php'); 
  } 
  </script>



<?php

// TO calculate Stats
$calc_stats = "SELECT avg(total_marks) as final_avg, min(total_marks) as final_min, max(total_marks) as final_max
FROM (SELECT participant_username,  SUM(marks_awarded2) as total_marks
FROM (SELECT participant_username, max(marks_awarded) as marks_awarded2 FROM submission WHERE contest_ID = '".$contestid."' GROUP BY round_number, participant_username) as X
GROUP BY participant_username) as Y";
$stats = $conn->query($calc_stats);
$get_stats = $stats->fetch_row();

// To calculate Each users marks
$sql = "SELECT SUM(marks_awarded2) as total_marks, participant_username
        FROM (SELECT participant_username, max(marks_awarded) as marks_awarded2 FROM submission WHERE contest_ID = '".$contestid."' GROUP BY round_number, participant_username) as X
        GROUP BY participant_username";
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
  echo "<th> $get_stats[0] </th>";
  echo "<th> $get_stats[2] </th>";
  echo "<th> $get_stats[1] </th>";
  echo "<br>";
echo "</thead></table>";
echo "<br>"; 

for($i = 1; $i <= $num_rounds; $i++){
?>

  <table class="styled-table"><thead>
  <tr>
  <th> Round <?php echo $i; ?> </th>
  <td><div class="btn-group4">
  <button id= "<?php echo $i; ?>" onclick="id_store(this.id)"  style="width:60%"> View Stats </button>
  </div></td>
  </tr>
<?php
  echo "</thead></table>";
} 

      $conn->close();
?> 

</div>

</body>
</html>
