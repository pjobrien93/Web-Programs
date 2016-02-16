<?php

$username = $_POST["uname"];
$password = $_POST["pword"];

$username = trim($username);
$password = trim($password);

$loginFlag = false;

if ($username == "guest" && $password == "dinner") {
  $loginFlag = true;
  setcookie ("username", $username, time()+24*3600);
  }
header('Location: http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/test3/dinner.php')

?>
