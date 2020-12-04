<?php
include "connect.php";

session_start();

$round_number = $_POST["round_number"];
$contest_ID = $_SESSION["contest_ID"];
$title = $_POST["title"];
$problem_statement = $_POST["problem_statement"];
$test_input = $_POST["test_input"];
$expected_output = $_POST["expected_output"];
$total_marks = $_POST["total_marks"];

if ($_SESSION["is_new_contest"])
{
    $sql = "INSERT INTO round (round_number, contest_ID, title, problem_statement, test_input, expected_output, total_marks) VALUES ('$round_number', '$contest_ID', '$title', '$problem_statement', '$test_input', '$expected_output', $total_marks)";

    if ($conn->query($sql) === TRUE) {
        redirect_to_contest_details($contest_ID);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else
{
    $sql = "UPDATE round SET title = '$title', problem_statement = '$problem_statement', test_input = '$test_input', expected_output = '$expected_output', total_marks = $total_marks WHERE round_number = $round_number AND contest_ID = $contest_ID";

    if ($conn->query($sql) === TRUE) {
        redirect_to_contest_details($contest_ID);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

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