<?php

// this function changes the element/item in the database
// inputs: the element ID string what we want to change
//         unique ID of person who's info we are changing
//         what we want to change it to
// output: change the database

function changeItem($elemID, $uniqueID, $changeTo) {
  // Connect to the MySQL database
  $host = "fall-2015.cs.utexas.edu";
  $user = "pjobrien";
  $file = fopen("/u/pjobrien/password.txt", "r");
  $line = fgets ($file);
  $pwd = trim ($line);
  fclose ($file);
  $dbs = "cs329e_pjobrien";
  $port = "3306";

  $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

  if (empty($connect)) {
    die("mysql_connect failed " . mysqli_connect_error());
  }

  $elemID = trim($elemID);
  $uniqueID = trim($uniqueID);
  $changeTo = trim($changeTo);

  // get the item we want to change from the front end
  $stmt = mysqli_prepare ($connect, "UPDATE userInfo SET $elemID = ? WHERE username= ?");
  mysqli_stmt_bind_param ($stmt, 'ss', $changeTo, $uniqueID) or die("Failed: ". mysqli_error($connect));
  mysqli_stmt_execute($stmt) or die("Failed: ". mysqli_error($connect));
  mysqli_stmt_close($stmt);

 // Close connection to the database
  mysqli_close($connect);
  return true;
}

$email = $_POST['email'];
$city = $_POST['city'];
$state = $_POST['state'];
//$uniqueID = $_COOKIE['username'];
$uniqueID = $_POST['username'];

if ($email != "") {
  $elemID = "email";
  changeItem($elemID, $uniqueID, $email);
}

if ($city != "") {
  $elemID = "city";
  changeItem($elemID, $uniqueID, $city);
}

if ($state != "") {
  $elemID = "state";
  changeItem($elemID, $uniqueID, $state);
}

print <<<THANK
<html>
<head>
  <title>DanceSport Connect</title>
</head>

<body>
  <h1>Thank you for updating your information!</h1>
  <a href="./homepage.html">Homepage</a>
</body>
</html>
THANK;

?>
