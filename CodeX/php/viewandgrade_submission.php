<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Code Submitted</title>
    <style type="text/css">
        body{
        background-image: linear-gradient(to left, rgb(7, 145, 85, 0.1), rgb(7, 145, 90, 0.6), rgba(7, 145, 85, 1));
        font-family: Arial, Helvetica,sans-serif;
        }
        .contest{
          color:red;
          float: left;
          color: blue;
          text-align: center;
          text-decoration: none;
          font-size: 30px; 
          line-height: 25px;
          border-radius: 4px;
        }

        .card {
          position: relative;
          top: 200px;
          right: 800px;
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
          transition: 0.3s;
          width: 20%;
          color: white;
        }


        .header b {
  position: absolute;
  top: 10px;
  right: 20px;
  color: black;
  text-align: center;
  padding: 20px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
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
  font-size: 25px;
  
}

.margin-auto{
  margin: auto;
}

table{
  margin-left:auto; 
  margin-right:auto;
  margin-top:auto;
  
  top: 20%;
  border: 1px solid black;
  
  width: 75%;
  background-color: #E6E1E0; 
}

th, td {
  height: 5px;
  padding: 10px;
}

.btn-group button {
  margin: auto;
  background-color: #0E5225; 
  border: 1px solid green; 
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}
.btn-group2 button {
  position: absolute;
  top: 50px;
  right: 15px;
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 10px 24px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group2 button:hover {
  background-color: #11346b;
}


    </style>
</head>

<body>




<div class="header">
  <a class="logo">
  Submission </a>
</div>
<br>



<div>

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
        $username = $_SESSION['username'];
        $contest_ID = $_GET["c_id"];
        $round_number = $_GET["r_no"];
        $times = $_GET['time'];
        $participant_name = $_GET['pname'];
        

        $sql = "SELECT * FROM submission WHERE round_number=$round_number AND contest_ID=$contest_ID AND time_stamp='$times' AND participant_username='$participant_name'";
        
        $result = $conn->query($sql);
        
        $row = $result->fetch_assoc();
        echo "<table>";
        echo "<th>"."Code Submitted by $participant_name (Round $round_number)"."</th>";
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
    }
}

$conn->close();

?>
</div>

<div>
<form action="submission.php" method="post">
<input type="hidden" name="pid" id="pid">
</form>
<div>

<div>

<table>
<th>
<?php echo "Marks Awarded: ";
echo ($row['marks_awarded']);
echo " / ";
echo $total_marks;
?>
        
        <div class="form">
        <fieldset>
            <form name="mg" autocomplete="off" action="manually_grade.php" method="post">
                <input type="hidden" name="round_number" value= "<?php echo $round_number ?>">
                <input type="hidden" name="contest_ID" value= "<?php echo $contest_ID ?>">
                <input type="hidden" name="total_marks" value= "<?php echo $total_marks ?>">
                <input type="hidden" name="pname" value= "<?php echo $participant_name ?>">     
                <input type="hidden" name="time" value= "<?php echo $times ?>">     

                <input name="marks" type="text" placeholder="Manually Grade Submission">          
                <input name="submit" type="submit">
            </form>
        </fieldset>
        </div>   
</th>
</table>
</div>


<div class="btn-group2">
    <button onclick="back('<?php echo $participant_name;?>')" style="width:200px">Back</button>
     </div>

  <script>
  function back(res)
  {
    var element = document.getElementById("pid");
    element.value = res;
    element.form.submit();
  }
</script>



</body>
</html>
  


