<?php

include "connect.php";

// Start session
session_start();

// If session doesnt have relevant variables
if (!(isset($_SESSION["username"]) && isset($_SESSION["is_admin"])))
{
    echo "Yeh kya baat hui yaar :( Aap kidhar?";
}
else
{
    if (!($_SESSION["is_admin"]))
    {
        echo $_SESSION["is_admin"];
        echo "<br>Yaar mujhe tou lagta hai aap admin hi nahi ho :(";
    }
    else
    {   
        $flag = 1;
        $contestid = $_POST['contest_ID'];
        $round_number = $_POST["round_number"];
        $pname = $_POST['pname'];
        $time = $_POST["time"];
        $total_marks = floatval($_POST["total_marks"]);

        $marks = floatval($_POST["marks"]);

        if (strval($marks) != "" && $marks <= $total_marks)
        {
            $flag = 0;
        }
        
        if (strval($marks) == "" and $marks != 0)
        {
            $flag = 404;
        }
        

        if ($total_marks < $marks || $marks < 0)
        {
            $flag = 405;
        }
        
        if ($flag == 0)
        {
        $sql = "UPDATE submission SET marks_awarded=$marks WHERE contest_ID=$contestid AND round_number=$round_number AND time_stamp='$time' AND participant_username='$pname'";         
        if ($conn->query($sql) === TRUE) {
        
        
        //echo '<script type="text/javascript">';          
        header('Location: viewandgrade_submission.php?c_id='.$contestid."&r_no=".$round_number."&time=".$time."&pname=".$pname); exit;
        //echo '</script>';
        echo "Marks Updated Successfully!";   
        echo "<br>";
        } 
        else {
        echo "Error updating marks!";
        echo "<br>";
        } 
        }
        
        if  ($flag == 405)
        {
            //echo '<script type="text/javascript">'; 
            header('Location: viewandgrade_submission.php?c_id='.$contestid."&r_no=".$round_number."&time=".$time."&pname=".$pname); exit;
            //echo '</script>';
            echo 'Please enter a valid value';
            echo "<br>";
        }

        if  ($flag == 404)
        {
            //echo '<script type="text/javascript">'; 
            header('Location: viewandgrade_submission.php?c_id='.$contestid."&r_no=".$round_number."&time=".$time."&pname=".$pname); exit;
            echo "Please enter a valid value";
            echo "<br>";
        }
      
    }
}

$conn->close();

?>

