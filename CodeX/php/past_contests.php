<?php
include "connect.php";
session_start();
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
           margin-top: 3em; 
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
      
    .margin-auto{
      margin: auto;
    }


 </style>
</head>

<body>
<div class="header">
  <a class="logo"> View Past Contests </a>
  <div class="btn-group2">
    <button onclick="document.location='past_live_contests.php'"  style="width:10%">Back</button>
  </div>
</div>
<br>

</div>
<form action="past_stats.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

<div>
<?php

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function timeAddition( $time, $plusMinutes ) {

  $time = DateTime::createFromFormat( 'Y-m-d H:i:s', $time );
  $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
  $newTime = $time->format( 'Y-m-d H:i:s' );
  return $newTime;
}

  date_default_timezone_set("Asia/Karachi");
  //$username = $_SESSION['username'];

  $currentdt = new DateTime();
  //echo $currentdt->format('Y-m-d H:i:s');

  $sql = "SELECT * FROM contest ORDER BY start_time DESC";
  $result = $conn->query($sql);
  echo "<table class=center> ";
  echo "<th>"."Contest ID"."</th>";
  echo "<th>"."Contest Name"."</th>";
  echo "<th>"."Admin"."</th>";
  echo "<th>"."Creation Time"."</th>";
  echo "<th>"."Starting Time"."</th>";
  echo "<th>"."Ending Time"."</th>";
  echo "<th>".""."</th>";
  //echo '<table border="1">';
  while ($row = $result->fetch_row()) {
  
    if($currentdt->format('Y-m-d H:i:s') > timeAddition($row[4],$row[5]) ){
          echo "<tr>";
    }
    
    for($i = 0; $i < $result->field_count; $i++){
      if($currentdt->format('Y-m-d H:i:s') > timeAddition($row[4],$row[5]) ){
        if ($i != 5)
        echo "<td>$row[$i]</td>";
        if ($i == 5)
        {
          $time = timeAddition($row[4],$row[$i]);
          echo "<td>$time</td>";
        }
    }
  }

  if($currentdt->format('Y-m-d H:i:s') > timeAddition($row[4],$row[5])){
?>
  <td><div class="btn-group">
  <button id= "<?php echo $row[0]; ?>" onclick="id_store(this.id)"  style="width:100%">Statistics</button>
  </div></td>
<?php
  }

}
echo "</table>";        

$conn->close();

?>
</div>
<script type="text/javascript">
  function id_store(clicked_id)
  {
    var res = parseInt(clicked_id);
    var element = document.getElementById("cid");
    element.value = res;
    element.form.submit();
    
    header('Location: past_stats.php'); 
  } 
  
  function back()
  {
    window.location.href = "admin_portal.php";
  }
</script>
</body>
</html>