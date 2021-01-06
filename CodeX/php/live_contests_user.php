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

        /* background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1)) */
        /* background-color: "red"; */
      }

      .header {
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 40px 10px;
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

      /* td:hover
      {
          color:rgb(0, 0, 0);
          background-color:rgba(81, 141, 162, 0.5);
          border-radius: 0.3cm;
      } */

      th:hover
      {
          background-color: #999;
      }

      .button {
        border: none;
        border-radius: 5px;
        color: white;
        padding: 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        width: 150px;
      }

      .button1 {
        background-color: #4CAF50; 
        color: white; 
        border: 2px solid #4CAF50;
      }

      .button1:hover {
        background-color: rgb(99,128,107);
        color: black;
      }

      .button_red {
        border: none;
        border-radius: 5px;
        color: white;
        padding: 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        background-color: #bd0808; 
        color: white; 
        border: 2px solid #bd0808;
        width: 150px;
      }

      .button_red:hover {
        background-color: #e00b0b;
        color: black;
      }

      .button_yellow {
        border: none;
        border-radius: 5px;
        color: white;
        padding: 4px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        background-color: #f5b642;
        color: white; 
        border: 2px solid #f5d442;
        width: 150px;
      }

      .button_yellow:hover {
        background-color: #f5b642;
        color: black;
      }

      .btn-group2 button {
        position: absolute;
        right: 38px;
        top: 48px;
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

      /* Style the tab */
      .tab {
        overflow: hidden;
        border-top: 1px solid #333;
        border-bottom: 1px solid #333;
        background-color: #f1f1f1;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
      }

      .tablinks1 {
        /* background-color: #555; */
        color: black;
        float: right;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        font-size: 17px;
        width: 25%;
      }

      .tablinks {
        /* background-color: #555; */
        color: black;
        float: right;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        font-size: 17px;
        width: 25%;
      }

      /* Style the buttons inside the tab */
      .tab button {
        /* background-color: inherit; */
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
      }

      /* Change background color of buttons on hover */
      .tab button:hover {
        background-color: #ccc;
      }

      /* Create an active/current tablink class */
      .tab button.active {
        /* background-color: #ccc; */
        background-color: #333;
      }

      /* Style the tab content */
      .tabcontent {
        display: none;
        padding: 6px 12px;
        -webkit-animation: fadeEffect 1s;
        animation: fadeEffect 1s;
        margin-left: 150px;
        margin-right: 150px;
      }

      /* Fade in tabs */
      @-webkit-keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
      }

      @keyframes fadeEffect {
        from {opacity: 0;}
        to {opacity: 1;}
      }
 </style>
</head>

<body>
<div class="header">
  <a class="logo"> View Live Contests </a>
  <div class="btn-group2">
    <button onclick="document.location='past_live_contests_user.php'"  style="width:10%">Back</button>
  </div>
</div>

<div class="tab">
      <button class="tablinks" onclick="document.location='register_into_contest.php'">Enroll Into Contests</button>
      <button class="tablinks" onclick="document.location='past_contests_user.php'">View All Past Contests</button>
      <button class="tablinks" onclick="document.location='live_contests_user.php'">View All Live Contests</button>
      <button class="tablinks" onclick="document.location='user_display_contests.php'">My Contests</button>
    </div>


</div>
<form action="live_rounds_user.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

<div>
<?php
//include "connect.php";
// Create connection
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

// Start session
//session_start();

    date_default_timezone_set("Asia/Karachi");
    $currentdt = new DateTime();
    //echo $currentdt->format('Y-m-d H:i:s');

    $sql = "SELECT * FROM contest ORDER BY contest_ID";
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
        
        if($currentdt->format('Y-m-d H:i:s') < timeAddition($row[4],$row[5]) ){
        echo "<tr>";
        }
      
      for($i = 0; $i < $result->field_count; $i++){
        if($currentdt->format('Y-m-d H:i:s') < timeAddition($row[4],$row[5]) ){
          if ($i != 5)
          echo "<td>$row[$i]</td>";
          if ($i == 5)
          {
            $time = timeAddition($row[4],$row[$i]);
            echo "<td>$time</td>";
          }
      }
    }

    if($currentdt->format('Y-m-d H:i:s') < timeAddition($row[4],$row[5])){
      ?>
    
  
    <td><div class="btn-group">
    <button onclick="id_store(this.id)" id= "<?php echo $row[0]; ?>" style="width:100%">View</button>
    </div></td>

    <?php
  
    }
 
  }
  echo "</table>";        
// }
//}

$conn->close();

?>
</div>
  <script>
  function back()
  {
    window.location.href = "admin_portal.php";
  }
  function id_store(clicked_id)
    {
      var res = parseInt(clicked_id);
      var element = document.getElementById("cid");
      element.value = res;
      element.form.submit();
      
      header('Location: live_rounds_user.php'); 
    } 
</script>
</body>
</html>
  


