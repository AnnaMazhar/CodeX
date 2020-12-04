 <?php
include "connect.php";

$uname = $_POST['username'];
$pass = $_POST['password'];


$sql = "SELECT username, password, first_name, last_name, email, date_of_birth, gender FROM participant WHERE username='".$uname."'";

$result = $conn->query($sql);

// Comment by Talha:
// We currently allow a participant and an admin to have the same username
// but by the following way of loggin in, the admin with the same username
// wont ever be able to log in because the code will think he is a participant :(

if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
  if($row["password"] == $pass)
  {
    echo "Welcome ".$row["username"];
    session_start();

    $_SESSION["is_admin"] = False;
    $_SESSION["username"] = $uname;
    
    echo "Session Variables settt!";
    header('Location: user_portal.php'); exit;
  }
  else
  {
    echo "Incorrect Password!";
  }
} else {

  $sql = "SELECT username, password, first_name, last_name, email, date_of_birth, gender, organization FROM admin WHERE username='".$uname."'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
    if($row["password"] == $pass)
    {
      echo "Welcome ".$row["username"];
      session_start();
      $_SESSION["first_name"] = $row["first_name"];
      $_SESSION["username"] = $uname;
      $_SESSION["is_admin"] = True;
      
      echo "Session Variables settt!";
      
      header('Location: admin_portal.php'); exit;
    }
    else
    {
      echo "Incorrect Password!";
    }
    }
  else{
    echo "User ".$uname." not found. Sign up!";
  }
}
$conn->close();

?> 
