<?php
    include "connect.php";

    session_start();

    $name = $_SESSION["username"];
    $rating = $_POST["rate"];
    $c_ID = $_GET["c_id"];

    $sql = "SELECT admin_username FROM contest WHERE contest_ID='".$c_ID."'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $ad_uname = $row['admin_username'];
    
    $sql = "INSERT INTO rating (admin_username, participant_username, rating_score) VALUES('$ad_uname', '$name', '$rating') ";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: view_and_attempt_contests.php?c_id=".$c_ID); exit;
        //echo("<script>location.href = 'view_and_attempt_contests.php?c_id=".$c_ID."';</script>");

        
    } else {
        $sql = "UPDATE rating SET rating_score= '".$rating."' WHERE participant_username='".$name."' ";
        $conn->query($sql);
        header("Location: view_and_attempt_contests.php?c_id=".$c_ID); exit;
        //echo("<script>location.href = 'view_and_attempt_contests.php?c_id=".$c_ID."';</script>");

    }

    $conn->close();


?>