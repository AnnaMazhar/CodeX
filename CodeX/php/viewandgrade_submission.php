<?php

include "connect.php";
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Code Submitted</title>
    <style type="text/css">
        body{
          margin: 0;
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
      background-color: #ccc; 
    }

    th, td {
      height: 5px;
      padding: 10px;
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
<form action=<?php echo "submission.php?c_id=".$_GET["c_id"]; ?> method="post">
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
  


