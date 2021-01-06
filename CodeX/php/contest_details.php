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
          margin-top: 3em;
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

//include "connect.php";

function timeAddition( $time, $plusMinutes ) {

  $time = DateTime::createFromFormat( 'Y-m-d H:i:s', $time );
  $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
  $newTime = $time->format( 'Y-m-d H:i:s' );
  return $newTime;
}

// Start session
//session_start();

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

        //echo <<<HTML
        ?>
        <script type="text/javascript">
        function id_store(clicked_id)
        {
          var res = parseInt(clicked_id);
          var element = document.getElementById("cid");
          element.value = res;
          element.form.submit();
          header('Location: edit_contest.php'); 
        } 
        </script>
        

        
        <td><div class="btn-group">
        <button  onclick="id_store(this.id)"  id= "<?php echo $row[0]; ?>" style="width:100%">View</button>
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