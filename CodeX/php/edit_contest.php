<?php

$servername = "localhost";
$username = "debian-sys-maint";
$password = "NVxKE4bCYGO8nV9Y";
$dbname = "Code-X";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title>Contest Details</title>
    <style type="text/css">
        body{
        background-color: rgb(99,128,107)
        }
        fieldset
        {        
          position: absolute;
          top: 140px;
          right: 500px;
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
            color: white;
          background-color: #11346b;
        }
        input[type=submit]:hover {
          background-color: #3e8e41;
        }

        legend{
        margin-left: auto;
        margin-right: auto;
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
        .form
        {
            background-color: grey;
            color: white;
        margin-top: 0px;
        }

        .rounds-table table{
          align: center;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        
        .rounds-table thead tr {
        background-color: grey;
        color: black;
        text-align: center;
        border: 1px solid black;
        }

        .rounds-table th, .rounds-table td {
          height: 5px;
          padding: 10px;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
        background-color: grey;
        color: black;
        text-align: center;
        border: 1px solid black;
        }

        .styled-table th,
        .styled-table td {
        padding: 12px 15px;
        }

        .btn-group button {
        position: absolute;
        top: 45px;
        right: 17px;
        background-color: #11346b; 
        border: 1px solid green; /* Green border */
        color: white; /* White text */
        padding: 10px 24px; /* Some padding */
        cursor: pointer; /* Pointer/hand icon */
        float: left; /* Float the buttons side by side */
        }
        .btn-group button:hover {
      background-color: #3e8e41;
    }

    .btn-group button {
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group-edit button {
  background-color: #0E5225; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group-delete button {
  background-color: #e74c3c; 
  border: 1px solid red; /* Green border */
  color: white; /* White text */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group2 button {
  position: absolute;
  top: 100px;
  right: 15px;
  background-color: #11346b; 
  border: 1px solid green; /* Green border */
  color: white; /* White text */
  padding: 5px 5px; /* Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
}

.btn-group2 button:hover {
  background-color: #0E5225;
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
    <button onclick="edit_round(<?php echo $next_round_number ?>)" style="width:25%">Add Rounds</button>
  </div>

  </div>
  <div class="btn-group2">
  <button onclick="cancel()" style="width:25%">Go Back to All Contests</button>
  </div>
 

    <table class="styled-table">
    <thead>
        <tr>
            <td>Contest ID</td>
            <td><?php echo $contestid ?></td>
        </tr>
    
        <tr>
            <td>Contest Name</td>
            <td><?php echo $name ?></td>
        </tr>
        <tr>
            <td>Time Created</td>
            <td><?php echo $timecreated ?></td>
        </tr>
        <tr >
            <td >Starting Time</td>
            <td><?php echo $starttime ?></td>
        </tr>

        <tr>
            <td>Duration (Minutes)</td>
            <td><?php echo $duration ?></td>
        </tr>
    </thead>
</table>

<div class="form">
        <fieldset>
            <legend> Edit Contest Details </legend>
            <form name="register" autocomplete="off" action="edit_contest2.php" method="post">
                <input name="name" type="text" placeholder="Enter new contest name" ><br>
                <input name="start_time" type="text" placeholder="Enter new start time" ><br>
                <input name="duration" type="text" placeholder="Enter new duration" ><br>
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
        echo<<<HTML
         <table class="styled-table"><thead>
        HTML;
         echo "<th>"."Round #"."</th>";
        echo "<th>"."Title"."</th>";
        echo "<th>"."Total Marks"."</th>";
        echo "<th>".""."</th><th>".""."</th>";
        //echo '<table border="1">';
        while ($row = $result->fetch_row()) {
        echo "<tr>";
          
        for($i = 0; $i < $result->field_count; $i++){
          echo "<td>$row[$i]</td>";
        }

        echo <<<HTML
        <td><div class="btn-group-edit"><button id=$row[0] onclick="edit_round(this.id)"  style="width:100%">Edit</button></div></td>
        HTML;
        echo <<<HTML
        <td><div class="btn-group-delete"><button id="delete$row[0]" onclick="delete_round(this.id)"  style="width:100%">Delete</button></div></td>
        HTML;
        echo "</tr>";
      }
      echo "</thead></table>"; 

      $conn->close();
?>
</div>

    <script type="text/javascript">
        function edit_round(round_number)
        {
          console.log(round_number);
          var element = document.getElementById("round_addition_form");
          element.value = round_number;
          element.form.submit();
        }
        function delete_round(round_number)
        {
          round_number = parseInt(round_number.substring(6));
          console.log(round_number);
          var element = document.getElementById("delete_round_form");
          element.value = round_number;
          element.form.submit();
        } 
        function cancel()
        {
          window.location.href = "contest_details.php";
        }
    </script>

</body>
</html>
