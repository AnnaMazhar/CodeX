<?php

include "connect.php";

$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$uname = $_POST['username'];
$pass = $_POST['password'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$DOB =  $_POST['date_of_birth'];
$org = $_POST['organization'];
$type = $_POST['type'];

session_start();

$_SESSION["uname_su_inp"] = $uname;
$_SESSION["fname_su_inp"] = $fname;
$_SESSION["lname_su_inp"] = $lname;
$_SESSION["pw_su_inp"] = $pass;
$_SESSION["email_su_inp"] = $email;
$_SESSION["dob_su_inp"] = $DOB;
$_SESSION["gender_su_inp"] = $gender;
$_SESSION["type_su"] = $type;
if ($type == "admin")
{
    $_SESSION["org_su_inp"] = $org;
}

// DOB check lagao
date_default_timezone_set("Asia/Karachi");
$curr_time = strtotime(date('Y-m-d'));
$DOB_time = strtotime($DOB);
$min_diff = 6*365*24*60*60; if ($type == "admin") {$min_diff = 18*365*24*60*60;}
if ($min_diff > ($curr_time - $DOB_time))
{
    header("Location: index.php?status=dob_wrong"); exit;
}

// Email Len Check:
if (strlen($email) > 30)
{
    header("Location: index.php?status=email_long"); exit;
}

// Username already existing check
$sql_checkuname = "SELECT username FROM $type WHERE username='$uname'";
$result = $conn->query($sql_checkuname);
if ($result->num_rows > 0) {
    header("Location: index.php?status=u_exists"); exit;
}
else
{
    if($type === "participant")
    {
        $sql_insertion = "INSERT INTO participant (username, password, first_name, last_name, email,date_of_birth, gender) VALUES ('$uname', '$pass', '$fname', '$lname', '$email', '$DOB', '$gender')";
    } else {
        $sql_insertion = "INSERT INTO admin (username, password, first_name, last_name, organization, email,date_of_birth, gender) VALUES ('$uname', '$pass', '$fname', '$lname', '$org', '$email', '$DOB', '$gender')";
    }

    if ($conn->query($sql_insertion) === TRUE) {

        $_SESSION["username"] = $uname;
        if ($type === "participant")
        {
            $_SESSION["is_admin"] = False;
        }
        else
        {
            $_SESSION["is_admin"] = True;
        }
        
        $_SESSION["uname_su_inp"] = "";
        $_SESSION["fname_su_inp"] = "";
        $_SESSION["lname_su_inp"] = "";
        $_SESSION["pw_su_inp"] = "";
        $_SESSION["email_su_inp"] = "";
        $_SESSION["dob_su_inp"] = "";
        $_SESSION["gender_su_inp"] = "";
        $_SESSION["org_su_inp"] = "";
        $_SESSION["type_su"] = "";

        header("Location: index.php?status=reg_success"); exit;
        
    } else {
        echo "Error: " . $sql_insertion . "<br>" . $conn->error;
    }
}

$conn->close();

?>