<?php
include "connect.php";
session_start();


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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
      fieldset
        {        
          position: absolute;
          top: 240px;
          right: 100px;
          width: 10em
        }
        input[type=text] {
          border: 2px solid #555;
          outline: none;
        }

        input[type=text]:focus{
          background-color: lightblue;
        }
        input[type=password] {
          border: 2px solid #555;
          outline: none;
        }

        input[type=password]:focus{
          background-color: lightblue;
        }
        input[type=submit] {
          background-color: #999;
        }
        

        legend{
            color:#333;
        margin-left: auto;
        margin-right: auto;
        }
        
        .form
        {
            background-color: grey;
            color: white;
        margin-top: 0px;
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
          /* margin-top: 5em; */
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

        .btn-group button {
        position: absolute;
        right: 38px;
        top: 10px;
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

      .btn-group button:hover {
        color: #404040 !important;
        font-weight: 700 !important;
        letter-spacing: 3px;
        background: none;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        transition: all 0.3s ease 0s;
      }

      .btn-group2 button {
        position: absolute;
        right: 38px;
        top: 90px;
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
        top: 50px;
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

    

  <?php



// If session doesnt have relevant variables
if (!(isset($_SESSION["username"]) && isset($_SESSION["is_admin"])))
{
    echo "Nopes";
}
else
{
    if (!($_SESSION["is_admin"]))
    {
        echo $_SESSION["is_admin"];
        echo "<br> Not an admin";
    }
    else
    {
        // Get Contest ID through POST
        $contestid = $_POST['cid'];

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

    }
}

?> 

<form action="add_round.php" method="post">
<input type="hidden" name="round_number" id="round_addition_form">
</form>

<form action="delete_round.php" method="post">
<input type="hidden" name="round_number" id="delete_round_form">
</form>

<div class="header">
  <a class="logo">  <?php echo $name ?> </a>
  <div class="btn-group">
    <button onclick="edit_round(<?php echo $next_round_number; ?>)" style="width:25%">Add Rounds</button>
  </div>

  </div>
  <div class="btn-group2">
  <button onclick="cancel()" style="width:25%">Go Back to All Contests</button>
  </div>
 
  </div>
  <div class="btn-group3">
  <button onclick="participants()" style="width:25%">View Participants</button>
  </div>
  <h2>Contest Details:</h2>

    <table class="styled-table">
    <thead>
        <tr>
            <th>Contest ID</th>
            <td><?php echo $contestid; ?></td>
        </tr>
    
        <tr>
            <th>Contest Name</th>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <th>Time Created</th>
            <td><?php echo $timecreated; ?></td>
        </tr>
        <tr >
            <th >Starting Time</th>
            <td><?php echo $starttime; ?></td>
        </tr>

        <tr>
            <th>Duration (Minutes)</th>
            <td><?php echo $duration; ?></td>
        </tr>
    </thead>
</table>

<div class="form">
        <fieldset>
            <legend> Edit Contest Details </legend>
            <form name="register" autocomplete="off" action="edit_contest2.php" method="post">
                <input name="name" type="text" placeholder="Enter new contest name" maxlength="20" ><br>
                <input name="start_time" type="text" placeholder="Enter new start time" pattern="\d{4}-\d{1,2}-\d{1,2}-\d{1,2}-\d{1,2}"><br>
                <input name="duration" type="text" placeholder="Enter new duration" pattern="\d{1,10}" maxlength="10" ><br>
                <br>
                <input name="submit" type="submit">
            </form>
        </fieldset>
    </div>  
<div class="center">

<h2>Rounds:</h2>

<?php

$sql = "SELECT round_number, title, total_marks FROM round WHERE contest_ID='".$contest_ID."' ORDER BY round_number";
        $result = $conn->query($sql);
        ?>
         <table class="styled-table"><thead>
        <?php
         echo "<th>"."Round #"."</th>";
        echo "<th>"."Title"."</th>";
        echo "<th>"."Total Marks"."</th>";
        echo "<th>".""."</th><th>".""."</th>";
        while ($row = $result->fetch_row()) {
        echo "<tr>";
          
        for($i = 0; $i < $result->field_count; $i++){
          echo "<td>$row[$i]</td>";
        }

        ?>
        <td><div class="btn-group-edit"><button id= "<?php echo $row[0]; ?>" onclick="edit_round(this.id)" >Edit</button></div></td>
        <td><div class="btn-group-delete"><button id="<?php echo "delete".$row[0]; ?>" onclick="delete_round(this.id)">Delete</button></div></td>
        <?php
        echo "</tr>";
      }
      echo "</thead></table>"; 

      $conn->close();
?>
</div>

    <script type="text/javascript">
        function edit_round(round_number)
        {
        //   console.log(parseInt(round_number));
          var element = document.getElementById("round_addition_form");
          element.value = parseInt(round_number);
          element.form.submit();
        }
        function delete_round(round_number)
        {
          round_number = round_number.substring(6);
          round_number = parseInt(round_number);
        //   console.log(round_number);
          var element = document.getElementById("delete_round_form");
          element.value = round_number;
          element.form.submit();
        } 
        function cancel()
        {
          window.location.href = "contest_details.php";
        }

        function participants()
        {
          window.location.href = "view_submission.php";
        }
    </script>

</body>
</html>