<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Contest Participants</title>
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
        margin-left:auto; 
          margin-right:auto;
          margin-top:auto;
        

        top: 10%;
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
        background-color: #0E5225; 
        border: 1px solid green; /* Green border */
        color: white; /* White text */
        cursor: pointer; /* Pointer/hand icon */
        width:170px;
        height: 20px;
        align:center;
      }

      .btn-group2 button {
        align: center;
        background-color: red; 
        border: 1px solid red; /* Green border */
        color: white; /* White text */
        cursor: pointer; /* Pointer/hand icon */
        width:170px;
        height: 20px;
        align:center;
        
      }

      .btn-group3 button {
        position: absolute;
        top: 50px;
        right: 15px;
        background-color: #0E5225; 
        border: 1px solid green; 
        color: white; 
        padding: 10px 24px;
        cursor: pointer;
        float: left; 
      }

      .btn-group3 button:hover {
        background-color: #11346b;
      }


      .btn-groupback button {
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
  <a class="logo"> Contest Participants</a>
</div>
<br>


<form action="submission.php" method="post">
<input type="hidden" name="pid" id="pid">
</form>


<form action="disqualify.php" method="post">
<input type="hidden" name="pname" id="pname">
</form>


<form action="edit_contest.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

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
        $contestid = $_SESSION['contest_ID']; 
        //$username = $_SESSION['username'];
        
        $sql = "SELECT username FROM participations WHERE contest_ID='".$contestid."'";
        $result = $conn->query($sql);

        echo "<table class=center> ";
        echo "<th>"."Participant"."</th>";
        echo "<th>".""."</th>";
        echo "<th>".""."</th>";

       
        while ($row = $result->fetch_row()) {
        echo "<tr>";
          
          for($i = 0; $i < $result->field_count; $i++){
          if ($i != 2 && $i != 5)
          echo "<td>$row[$i]</td>";
        }

        echo <<<HTML
        <script type="text/javascript">
        function id_store(clicked_id)
        {
          var res = clicked_id;
          var element = document.getElementById("pid");
          element.value = res;
          element.form.submit();
          header('Location: submission.php'); 
        } 
        </script>
        HTML;

        echo <<<HTML
        <td><div class="btn-group">
        <button id=$row[0] onclick="id_store(this.id)">View Submission</button>
        </div></td>
        HTML;

        
        echo <<<HTML
        <td><div class="btn-group2">
        <button id=$row[0] onclick="id_store2(this.id)">Disqualify</button>
        </div></td>
        HTML;
      }
      echo "</table>";        
    }
}

$conn->close();

?>
</div>

<div class="btn-group3">
  <button onclick="back('<?php echo $contestid;?>')" style="width:200px">Back</button>
  </div>

  <script>
  function back(res)
  {
    var element = document.getElementById("cid");
    element.value = res;
    element.form.submit();
  }

  
  function id_store2(clicked_username)
  {
    var res = clicked_username;
    var element = document.getElementById("pname");
    element.value = res;
    element.form.submit();
    header('Location: disqualify.php'); 
  } 
</script>
</body>
</html>
  


