<?php

include "connect.php";
$participant = $_POST['pid'];
$contest = $_GET['c_id'];
// Start session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Participant Submissions</title>
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
      th:hover
        {
            background-color: #999;
        }

       
    </style>
</head>


<body>
<div class="header">
<a class="logo"> <?php echo "".$participant."'s" ?> Submissions </a>
<div class="btn-group2">
  <button onclick="back()" style="width:200px">Back</button>
  </div>
</div>
<br>

<form action="edit_contest.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

<?php

// If session doesnt have relevant variables
if (!(isset($_SESSION["username"]) && isset($_SESSION["is_admin"])))
{
    echo "Nope, Bye";
}
else
{
    if (!($_SESSION["is_admin"]))
    {
        echo $_SESSION["is_admin"];
        echo "Again, Bye";
    }
    else
    {   
        // Get Participant Username through POST
        

        $sql = "SELECT * FROM submission WHERE participant_username='".$participant."' and contest_ID='".$contest."' ORDER BY round_number";
        $result = $conn->query($sql);
        echo "<table class=center> ";
        echo "<th>"."Round Number"."</th>";
        echo "<th>"."Time Stamp"."</th>";
        
        echo "<th>"."Interpretor Result"."</th>";
        echo "<th>"."Marks Awarded"."</th>";
        echo "<th>"."Submitted Code"."</th>";
    
        while ($row = $result->fetch_row()) {
        echo "<tr>";
          for($i = 0; $i < $result->field_count; $i++){
          if ($i != 0 && $i != 3 && $i != 4)
            echo "<td>$row[$i]</td>";
        }
        $c_id = $row[0];
        $r_no = $row[1];
        $time = ($row[2]);
       
        // Send values to view and grade
        $loc = "viewandgrade_submission.php?c_id=".$c_id."&r_no=".$r_no."&time=".$time."&pname=".$participant;
        $click = "document.location = '".$loc."'";
        echo '<td><button onclick = "'.$click.'" class="button button1">View</button></td>';
      }
      echo "</table>";        
    }
}

$conn->close();

?>


<div>
  <script>
  function back()
  {
    window.location.href = "view_submission.php";
  }

  function participants()
  {
    window.location.href = "view_submission.php";
  }
  </script>
</div>
</body>
</html>
  


