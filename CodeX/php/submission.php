<?php

include "connect.php";

// Start session
session_start();

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
        $participant = $_POST['pid'];

        $sql = "SELECT * FROM submission WHERE participant_username='".$participant."' ORDER BY round_number";
        $result = $conn->query($sql);
        echo "<table class=center> ";
        echo "<th>"."Round Number"."</th>";
        echo "<th>"."Time Stamp"."</th>";
        
        echo "<th>"."Interpretor Result"."</th>";
        echo "<th>"."Marks Awarded"."</th>";
        //echo "<th>".""."</th>";
        echo "<th>"."Submitted Code"."</th>";
        //echo '<table border="1">';
        while ($row = $result->fetch_row()) {
        echo "<tr>";
          for($i = 0; $i < $result->field_count; $i++){
          if ($i != 0 && $i != 3 && $i != 4)
            echo "<td>$row[$i]</td>";
        }
        echo "<td>$row[4]</td>";
      }
      echo "</table>";        
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Participant Submissions</title>
    <style type="text/css">
        body{
        background-color: rgb(99,128,107);
        font-family: Arial, Helvetica,sans-serif;
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

.margin-auto{
  margin: auto;
}

table{
  position: absolute;
  right: 10%;
  left: 10%;
  margin-left:auto; 
  margin-right:auto;
  align: center;
  top: 120px;
  align: center;
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
  width: 75%;
  background-color: grey; 
}

th, td {
  height: 5px;
  padding: 10px;
}

.btn-group button {
  margin: auto;
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group2 button {
  margin: auto;
  position: absolute;
  top: 50px;
  right: 40px;
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
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
</body>
</html>
  


