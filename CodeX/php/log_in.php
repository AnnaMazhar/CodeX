<?php
include "connect.php";
session_start();

$uname = $_POST['username'];
$pass = $_POST['password'];
$type = $_POST['type'];


$_SESSION['uname_logininput'] = $uname;
$_SESSION['pw_logininput'] = $pass;
$_SESSION['type_login'] = $type;

if($type === "participant")
{
  $sql = "SELECT username, password, first_name, last_name, email, date_of_birth, gender FROM participant WHERE username='".$uname."'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row["password"] == $pass)
    {
      echo "Welcome ".$row["username"];
      $_SESSION["is_admin"] = False;
      $_SESSION["username"] = $uname;

      $_SESSION['uname_logininput'] = "";
      $_SESSION['pw_logininput'] = "";
      $_SESSION['type_login'] = "";
      
      echo "<script>location.href ='user_portal.php' </script>";
    //   header('Location: user_portal.php'); exit;
    }
    else
    {
        echo "<script>location.href ='index.php?status=inc_pw' </script>";
    //   header("Location: index.php?status=inc_pw");
    }
  }
  else
  {
      echo "<script>location.href ='index.php?status=u_d_exists' </script>";
    // header("Location: index.php?status=u_d_exists");
  }
}
else
{

  $sql = "SELECT username, password, first_name, last_name, email, date_of_birth, gender, organization FROM admin WHERE username='".$uname."'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row["password"] == $pass)
    {
      echo "Welcome ".$row["username"];
      $_SESSION["first_name"] = $row["first_name"];
      $_SESSION["username"] = $uname;
      $_SESSION["is_admin"] = True;
      echo "<script>location.href ='admin_portal.php' </script>";
    //   header('Location: admin_portal.php'); exit;
    }
    else
    {
        echo "<script>location.href ='index.php?status=inc_pw' </script>";
    //   header("Location: index.php?status=inc_pw"); 
    }
  }
  else
  {
      echo "<script>location.href ='index.php?status=u_d_exists' </script>";
    // header("Location: index.php?status=u_d_exists");
  }
}

$conn->close();

?> 
