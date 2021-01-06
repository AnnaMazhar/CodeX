<?php

include "connect.php";
session_start();

$participant_name = $_POST["pname"];

//$sql = "DELETE FROM participant WHERE username = $participant_name";

$sql = "DELETE FROM participations WHERE username = '$participant_name'";

if ($conn->query($sql) === TRUE) {
    reload_page();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

function reload_page() {
    ?>
        <script type="text/javascript"> 
            alert("Participant Disqualified Successfully!");
            window.onload=function(){
                window.location.href = "view_submission.php";
            }
        </script>
    <?php
}

$conn->close();

?>


