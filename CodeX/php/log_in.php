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

$uname = $_POST['username'];
$pass = $_POST['password'];


$sql = "SELECT username, password FROM participant WHERE username='".$uname."'";

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
    $_SESSION["username"] = $uname;
    $_SESSION["is_admin"] = False;
    
    echo "Session Variables settt!";
    header('Location: ../html/participant.html'); exit;
  }
  else
  {
  	echo "Incorrect Password!";
  }
} else {

  $sql = "SELECT username, password FROM admin WHERE username='".$uname."'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
  // output data of each row
  $row = $result->fetch_assoc();
	  if($row["password"] == $pass)
	  {
      echo "Welcome ".$row["username"];
      session_start();
      $_SESSION["username"] = $uname;
      $_SESSION["is_admin"] = True;
      
      echo "Session Variables settt!";
      
      header('Location: ../html/admin.html'); exit;
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