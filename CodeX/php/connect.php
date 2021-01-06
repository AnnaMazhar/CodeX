<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "Code-X";

// $servername = "localhost";
// $username = "debian-sys-maint";
// $password = "NVxKE4bCYGO8nV9Y";
// $password = "WjniZbWoWwngK07Y";
// $dbname = "Code-X";

$servername = "localhost";
$username = "id15650265_mycat";
$password = "*CW(1k{%3{0xw{J%";
$dbname = "id15650265_codex";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>