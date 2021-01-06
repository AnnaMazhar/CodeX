<?php

include "connect.php";
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Contest Participants</title>
    <style type="text/css">
        body { 
        margin: 0;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;
      }
      
      .header {
  overflow: hidden;
  background-color: #f1f1f1;
  -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
  -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.7);
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

      .btn-group3 button {
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

      .btn-group3 button:hover {
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
  <a class="logo"> Contest Participants</a>
</div>
<br>


<form action= <?php echo "submission.php?c_id=".$_SESSION['contest_ID']; ?> method="post">
<input type="hidden" name="pid" id="pid">
<!-- <input type="hidden" name="cid" id="cid"> -->
</form>


<form action="disqualify.php" method="post">
<input type="hidden" name="pname" id="pname">
</form>


<form action="edit_contest.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

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

        ?>

        <script type="text/javascript">
        function id_store(clicked_id)
        {
          var res = (clicked_id);
          var element = document.getElementById("pid");
          element.value = res;
          element.form.submit();
          //location.href = 'submission.php';
          //header('Location: submission.php'); 
        } 
        </script>
   
        <td><div class="btn-group">
        <button onclick="id_store(this.id)" id="<?php echo $row[0]; ?>">View Submission</button>
        </div></td>


        <td><div class="btn-group2">
        <button onclick="id_store2(this.id)" id="<?php echo $row[0];?>">Disqualify</button>
        </div></td>

      <?php
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
  


