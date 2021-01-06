<?php

include "connect.php";

// Start session
session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Code Submitted</title>
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
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
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

      .margin-auto{
        margin: auto;
      }

      tr, td, th
      {
          border-style: groove;
          border-width: 0cm;
          color: rgba(0, 0, 0, 0.705);
          /* border-color: rgba(158, 94, 105, 0.4); */
          background-color: rgba(64, 65, 66, 0.1);
          padding: 10px 20px;
          /*text-align: center;*/
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


    </style>
</head>

<body>

<div class="header">
  <a class="logo">
  Submitted Code </a>
</div>
<br>

<div>

<?php

include "connect.php";

  
$username = $_SESSION['username'];
$contest_ID = $_GET["c_id"];
$round_number = $_GET["r_no"];
$times = $_GET['time'];
$participant_name = $_GET['pname'];


$sql = "SELECT * FROM submission WHERE round_number=$round_number AND contest_ID=$contest_ID AND time_stamp='$times' AND participant_username='$participant_name'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();
echo "<table>";
echo "<th>"."Round $round_number"."</th>";
echo "<tr>";
echo "<th>"."$times"."</th>";
echo "<tr>";
echo "<td>";
echo  "<pre>";
echo ($row['submitted_code']);
echo "</pre>";
echo "</td>";  
echo "</tr>";
echo "</table>";

$sql1 = "SELECT total_marks FROM round WHERE round_number=$round_number AND contest_ID=$contest_ID";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$total_marks = $row1['total_marks'];

$conn->close();

?>

<table>
<th>
<?php echo "Marks Awarded: ";
echo ($row['marks_awarded']);
echo " / ";
echo $total_marks;
?>

</th>
</table>
</div>


<div class="btn-group2">
    <button onclick="back()" style="width:200px">Back</button>
     </div>

  <script>
  function back(res)
  {
    window.location.href = "user_display_contests.php";
  }
</script>



</body>
</html>
  


