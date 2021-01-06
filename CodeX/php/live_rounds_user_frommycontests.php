<?php
include "connect.php";
session_start();

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session

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
              font-family: URW Gothic L;
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



// If session doesnt have relevant variables
// if (!(isset($_SESSION["username"]) && isset($_SESSION["is_admin"])))
// {
//     echo "Nopes";
// }
// else
// {
//     if (!($_SESSION["is_admin"]))
//     {
//         echo $_SESSION["is_admin"];
//         echo "<br> Not an admin";
//     }
//     else
//     {
        // Get Contest ID through POST
        $contestid = $_GET['c_id'];

        // Set Session Variable
        $_SESSION['contest_ID'] = $contestid;

        $sql = "SELECT * FROM contest WHERE contest_ID='".$contestid."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $name = $row['name'];
        $timecreated = $row['time_created'];
        $starttime = $row["start_time"];
        $duration = $row["duration"];

        // get the next round number:
        $contest_ID = $contestid; //set with session variable
        $next_round_number = 1; //get from query
        $sql = "SELECT max(round_number) AS max_round_number FROM round WHERE contest_ID = $contestid";
        $resultt = $conn->query($sql);
        if ($resultt->num_rows > 0)
        {
          $row = $resultt->fetch_assoc();
          $next_round_number = $row["max_round_number"] + 1;
        }
        // done getting the next round number

//     }
// }

?> 

 <div class="header">
  <a class="logo"> Round Details </a>
  <div class="btn-group2">
    <button onclick="document.location='user_display_contests.php'"  style="width:10%">Back</button>
  </div>
</div>

<?php

$sql = "SELECT round_number, title, total_marks FROM round WHERE contest_ID='".$contest_ID."' ORDER BY round_number";
        $result = $conn->query($sql);
        ?>
        
         <table class="styled-table"><thead>
        
        <?php 
         echo "<th>"."Round #"."</th>";
        echo "<th>"."Title"."</th>";
        echo "<th>"."Total Marks"."</th>";
        //echo '<table border="1">';
        while ($row = $result->fetch_row()) {
        echo "<tr>";
          
        for($i = 0; $i < $result->field_count; $i++){
          echo "<td>$row[$i]</td>";
        }
      }
      echo "</thead></table>"; 

      $conn->close();
?>
</div>

</body>
</html>
