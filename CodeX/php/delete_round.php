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

session_start();

$round_number = $_POST["round_number"];
$contest_ID = $_SESSION["contest_ID"];

$sql = "DELETE FROM round WHERE round_number = $round_number AND contest_ID = $contest_ID";

if ($conn->query($sql) === TRUE) {
    redirect_to_contest_details($contest_ID);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

function redirect_to_contest_details($contest_ID) {
    echo <<<HTML
        <!DOCTYPE html>
        <html>
        <body><form action="edit_contest.php" method="post">
        <input type="hidden" name="cid" id="cid" value="$contest_ID">
        </form>
        <script type="text/javascript"> 
            window.onload=function(){
                var element = document.getElementById("cid");
                element.form.submit();
            }
        </script>
        </body>
        </html>
    HTML;
}

$conn->close();

?>