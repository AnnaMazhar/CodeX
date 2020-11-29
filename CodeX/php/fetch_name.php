<?php
session_start();


if (!($_SESSION["username"]))
{
    #echo $_SESSION["is_admin"];
    echo "<br>Bye Thanks";
}
else
{
    $participant_username = $_SESSION["username"];
    $sql = "SELECT first_name FROM participant WHERE username='".$participant_username."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['first_name'];
}


$conn->close();
?>