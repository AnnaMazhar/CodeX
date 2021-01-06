<?php

include "connect.php";

session_start();

$round_number = $_POST["round_number"];
$contest_ID = $_SESSION["contest_ID"];

date_default_timezone_set("Asia/Karachi");
$time_curr = date("Y-m-d H:i:s");
$sql = "SELECT start_time from contest WHERE contest_ID='".$contest_ID."' ";
$result = $conn->query($sql);
$row = $result->fetch_row();
$s_time = $row[0];

if(strtotime($s_time) < strtotime($time_curr) ) {
      { echo '<script type="text/javascript">'; 
        echo 'alert("You can not delete rounds after a contest has started");'; 
        echo 'window.location.href = "contest_details.php";';
        echo '</script>';}
        }
else {

$sql = "DELETE FROM round WHERE round_number = $round_number AND contest_ID = $contest_ID";

if ($conn->query($sql) === TRUE) {
    redirect_to_contest_details($contest_ID);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

function redirect_to_contest_details($contest_ID) {
    ?>
        <!DOCTYPE html>
        <html>
        <body><form action="edit_contest.php" method="post">
        <input type="hidden" name="cid" id="cid" value= <?php echo "$contest_ID" ?>>
        </form>
        <script type="text/javascript"> 
            window.onload=function(){
                var element = document.getElementById("cid");
                element.form.submit();
            }
        </script>
        </body>
        </html>
    <?php
}

$conn->close();

?>