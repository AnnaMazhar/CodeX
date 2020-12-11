<?php
include "connect.php";
session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>Contest Details</title>
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
  font-size: 35px;
  font-weight: bold;
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
  <a class="logo"> My Contests </a>
  <div class="btn-group2">
    <button onclick="document.location='admin_portal.php'"  style="width:10%">Back</button>
  </div>
</div>
<br>

<form action="edit_contest.php" method="post">
<input type="hidden" name="cid" id="cid">
</form>

<div>
<?php
function timeAddition( $time, $plusMinutes ) {

  $time = DateTime::createFromFormat( 'Y-m-d H:i:s', $time );
  $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
  $newTime = $time->format( 'Y-m-d H:i:s' );
  return $newTime;
}

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
        
        $sql = "SELECT * FROM contest WHERE admin_username='".$username."' ORDER BY start_time DESC";;
        $result = $conn->query($sql);
        echo "<table class=center> ";
        echo "<th>"."Contest ID"."</th>";
        echo "<th>"."Contest Name"."</th>";
        echo "<th>"."Creation Time"."</th>";
        echo "<th>"."Starting Time"."</th>";
        echo "<th>"."Ending Time"."</th>";
        echo "<th>".""."</th>";
        //echo '<table border="1">';
        while ($row = $result->fetch_row()) {
        echo "<tr>";
          
          for($i = 0; $i < $result->field_count; $i++){
          if ($i != 2 && $i != 5)
          echo "<td>$row[$i]</td>";
          if ($i == 5)
          {
            $time = timeAddition($row[4],$row[$i]);
            echo "<td>$time</td>";
          }
        }

        // echo <<<HTML
        ?>
        <script type="text/javascript">
        function id_store(clicked_id)
        {
          var res = parseInt(clicked_id);
          // window.print(clicked_id);
          var element = document.getElementById("cid");
          element.value = res;
          element.form.submit();
          
          header('Location: edit_contest.php'); 
        } 
        </script>
        
        <td><div class="btn-group">
        <button id = <?php echo $row[0]; ?> onclick="id_store(this.id)"  style="width:100%">View</button>
        </div></td>
        <?php
      }
      echo "</table>";        
    }
}

$conn->close();

?>
</div>
  <script>
  function back()
  {
    window.location.href = "admin_portal.php";
  }
</script>
</body>
</html>
  


