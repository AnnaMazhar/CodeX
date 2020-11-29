<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Register / Login</title>
    
    <!-- <style type="text/css">
        body{
        background-color: #2ecc71
        }
        .btn-group button {
      position: absolute;
      top: 115px;
      left: 5px;
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

    </style> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .top_pad {
            padding-top: 20px;
        }
        .full_width {
            width: 100%;
        }
        .some_height {
            height: 80px;
        }
        /* .no_padding_below {
            padding-top: 0px;
        } */
        /* body{
            background-color: #2ecc71;
            font-family: Arial, Helvetica,sans-serif;
        } */
    </style>
</head>



<body>

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

// If session doesnt have relevant variables
if (!(isset($_SESSION["contest_ID"]) && isset($_SESSION["username"]) && isset($_SESSION["is_admin"])))
{
    echo "Round Number and Contest ID Session Variables needed";
}
else
{

    $_SESSION["is_new_contest"] = True;
    
    $username = $_SESSION['username'];
    $round_number = $_POST["round_number"];
    $contest_ID = $_SESSION["contest_ID"];
    
    echo <<<HTML
    <script type="text/javascript">
        console.log($round_number);
    </script>
    HTML;

    $title = "";
    $problem_statement = "";
    $test_input = "";
    $expected_output = "";
    $total_marks = "";
    
    $sql = "SELECT title, problem_statement, test_input, expected_output, total_marks FROM round WHERE round_number='".$round_number."' AND contest_ID='".$contest_ID."'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();

        $_SESSION["is_new_contest"] = False;

        $title = $row["title"];
        $problem_statement = $row["problem_statement"];
        $test_input = $row["test_input"];
        $expected_output = $row["expected_output"];
        $total_marks = $row["total_marks"];
    }

    $sql = "SELECT name FROM contest WHERE contest_ID='".$contest_ID."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $contest_name = $row["name"];
}



?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Round #<?php echo $round_number ?></h1>
            </div>
            <div class="col-md-6 text-right">
                <h3><?php echo $contest_name ?></h3>
                <h4><?php echo $username ?></h4>
            </div>
        </div>
    </div>

    <div class="container">
        <fieldset>
            <!-- <legend> Round Details: </legend> -->
            <form name="login" action="../php/submit_round.php" method="post">
                <label>Title:</label><br>
                <input class="full_width" name="title" type="text" placeholder="Enter Here" required="" value="<?php echo $title ?>"></input><br>
                <br>
                <label>Total Marks:</label><br>
                <input class="full_width" name="total_marks"  value="<?php echo $total_marks ?>" type="number" placeholder="Enter Here" required=""></input><br>
                <br>
                <label>Problem Statement:</label><br>
                <textarea class="full_width some_height" name="problem_statement" type="text" placeholder="Enter Here" required=""><?php echo $problem_statement ?></textarea><br>
                <br>
                <label>Test Input:</label><br>
                <textarea class="full_width some_height" name="test_input" type="text" placeholder="Enter Here" required=""><?php echo $test_input ?></textarea><br>
                <br>
                <label>Expected Output:</label><br>
                <textarea class="full_width some_height" name="expected_output" type="text" placeholder="Enter Here" required=""><?php echo $expected_output ?></textarea><br>
                <br>
                <input type="hidden" name="round_number" value="<?php echo $round_number ?>">
                <input name="submit" type="submit">
            </form>
        </fieldset>
        <button onclick="cancel(<?php echo $contest_ID ?>)">Cancel</button>
    </div>

    <form action="edit_contest.php" method="post">
        <input type="hidden" name="cid" id="cid">
    </form>

    <script>
        function cancel(contest_ID)
        {
            var element = document.getElementById("cid");
            element.value = contest_ID;
            element.form.submit();
        }
    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();

?>
