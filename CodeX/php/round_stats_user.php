<?php 
include "connect.php";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();

$contestid = $_SESSION['contest_ID'];
$round_num = $_POST['cid'];
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

 </style>
</head>
<body>

  <?php
 

        $sql = "SELECT name FROM contest WHERE contest_ID='".$contestid."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['name'];

        $sql_2 = "SELECT max(round_number) AS max_round_number FROM round WHERE contest_ID = '".$contestid."'";
        $resultt = $conn->query($sql_2);
        $row_two = $resultt->fetch_assoc();
        $num_rounds = $row_two["max_round_number"]; // Now i have the number of rounds

        $sql_3 = "SELECT count(DISTINCT participant_username) AS counter FROM submission WHERE contest_ID = '".$contestid."'";
        $result3 = $conn->query($sql_3);
        $row_three = $result3->fetch_assoc();
        $num_users = $row_three["counter"]; // Now i have the number of participants

?>  

 <div class="header">
  <a class="logo"> <?php echo "Round Statistics"?> </a>
  <div class="btn-group2">
    <button onclick="document.location='past_contests_user.php'"  style="width:10%">Back</button>
  </div>
</div>
<br>


<?php

$sum =0;
$count =0;
$lowest = 1000;
$highest = 0;
$avg = 0;

$sql = "SELECT participant_username, marks_awarded FROM submission WHERE contest_ID='".$contestid."' AND round_number = '".$round_num."'
        ORDER BY participant_username";
        $result = $conn->query($sql);
        echo<<<HTML
         <table class="styled-table"><thead>
        HTML;
         echo "<th>"."Participant Name"."</th>";
         echo "<th>"."Total Marks"."</th>";
        
       while ($row = $result->fetch_row()) {
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> $row[1] </td>";
        $sum = $sum + $row[1];
        $count = $count + 1;
        if($row[1] < $lowest){
          $lowest = $row[1];
        }
        if($row[1]> $highest){
          $highest = $row[1];
        }
      }
       if($count !=0)
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
     
      echo "</thead></table>"; 

      $conn->close();
?> 

</div>

</body>
</html>
