<?php
    include "connect.php";

    function timeAddition( $time, $plusMinutes ) {
    $time = DateTime::createFromFormat( 'Y-m-d H:i:s', $time );
    $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
    $newTime = $time->format( 'Y-m-d H:i:s' ); 
    return $newTime; }

    //username fetch
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
    $uname = $_SESSION["username"];
    $submitted_code = $_POST['editor'];
    $code_to_save = str_replace("\"","\\\"",$submitted_code);

    date_default_timezone_set("Asia/Karachi");
    $time = date("Y-m-d H:i:s");

    $contest_ID = $_POST["contest_ID"];
    $round_number = $_POST["round_number"];

    $sql2 = "SELECT start_time, duration from contest WHERE contest_ID='".$contest_ID."' ";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_row();
    $start_time = $row2[0];
    $duration = $row2[1];

    if( strtotime($time) >  strtotime(timeAddition($start_time, $duration ))){
        echo '<script type="text/javascript">'; 
        echo 'alert("Deadline to submit has passed. Try again next time!");'; 
        echo 'window.location.href = "user_display_contests.php";';
        echo '</script>';
    }
    else{

    $sql = "SELECT test_input, expected_output, total_marks FROM round WHERE round_number=$round_number AND contest_ID=$contest_ID";
    $result = $conn->query($sql);
    if ($result->num_rows <= 0)
    {
        echo "ye kyaa";
    }
    $row = $result->fetch_assoc();
    $test_input = $row['test_input'];
    $expected_output = $row['expected_output'];
    $total_marks = $row['total_marks'];

    include "run_interpreter.php";

    $sql = "INSERT INTO submission (contest_ID, round_number, time_stamp, participant_username, submitted_code, interpretor_result, marks_awarded) VALUES ($contest_ID, $round_number, '$time', '$uname', \"$code_to_save\", '$interpreter_result', $marks_awarded)";

    if ($conn->query($sql) === TRUE) {

        echo "<h4> Your code is submitted! </h4>"; 
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT submitted_code FROM submission WHERE round_number=$round_number AND contest_ID=$contest_ID AND time_stamp='$time' AND participant_username='$uname'";
    $result = $conn->query($sql);
    if ($result->num_rows <= 0)
    {
        echo "ye kyaaaaa";
    }
    $row = $result->fetch_assoc();
    $code_binary = $row['submitted_code'];
    echo nl2br($code_binary);

    $conn->close();

    // set session variables
    $_SESSION["interpretor_result_msg"] = $interpretor_result_msg;
    $_SESSION["submitted_code"] = $submitted_code;

    //header("Location: ../php/code_editor.php?c_id=$contest_ID&r_no=$round_number");

    echo ("<script>location.href = '../php/code_editor.php?c_id=$contest_ID&r_no=$round_number';</script>");
 
    }
    exit;

?>