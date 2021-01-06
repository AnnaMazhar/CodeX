<?php 
include "connect.php";
session_start();
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$contestid = $_GET['c_id']; 
$_SESSION['contest_ID'] = $contestid;
$prev_page = $_GET['prev'];// MODIFIED STATEMENT
$uname = $_SESSION["username"];

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

  <?php
          
        
  $name_check = "SELECT count(username) FROM participations WHERE username = '".$uname."' and contest_ID = '".$contestid."' ";
  $check = $conn->query($name_check);
  $check_result = $check->fetch_row();

  if($check_result[0] == 0){
    echo '<script type="text/javascript">'; 
    echo 'alert("You did not participate in this contest");'; 
    echo 'window.location.href = "past_contests_user.php";';
    echo '</script>';
   }

  else{
  $sql = "SELECT name FROM contest WHERE contest_ID='".$contestid."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $name = $row['name'];

   $sql2 = "SELECT first_name, last_name FROM participant WHERE username='".$uname."'";

    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();

    $fname = $row2['first_name'];
    $lname = $row2["last_name"];

  ?> 

 <div class="header">
  <a class="logo"> <?php echo "My Performance" ?> </a>
  <div class="btn-group2">
    <button onclick="document.location='<?php echo $prev_page ?>.php'"  style="width:10%">Back</button>
  </div>
</div>
<br>


<?php

$get_sum =  "SELECT sum(total) as total_marks From 
            (SELECT max(marks_awarded) as total FROM submission WHERE contest_ID='".$contestid."' AND participant_username = '".$uname."'
            GROUP BY round_number) as Y";
$summation = $conn->query($get_sum);
$sum = $summation->fetch_row();

$sql = "SELECT round_number, max(marks_awarded) FROM submission WHERE contest_ID='".$contestid."' AND participant_username = '".$uname."'
        GROUP BY round_number";
$result = $conn->query($sql);
?>
 <table class="styled-table"><thead>
<?php
 echo "<th>"."Participant Name"."</th>";
 echo "<th> $fname $lname </th>";
 echo "<th>"."Submission"."</th>";

while ($row = $result->fetch_row() ) {
echo "<tr>";
echo "<td> Round $row[0] </td>";
echo "<td> $row[1] </td>"; 
?>

<td> <button id= "<?php echo $row[0]; ?>" onclick="id_store(this.id)"  class="btn-group4" > View </button> </td>
<?php
}
echo "</thead></table>"; 

// echo "</thead></table>";
echo "<br>";
?>

<table style= 'margin-top: 1em;' ><thead>
<?php
echo "<th style= 'border-top-left-radius: 0cm; border-top-right-radius: 0cm;'>"."Total Score"."</th>";
echo "<td > $sum[0] </td>"; 
// echo "<td> </td>"; 
        
        $conn->close();
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
    
    header('Location: my_stats.php'); 
  } 

  </script>

<form action="round_submissions_user.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

</body>
</html>
