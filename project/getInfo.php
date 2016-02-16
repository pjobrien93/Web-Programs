<?php

// input: username of user
// output: an array of the form [username, first, last, email, city, state, birthdate]
// use the array in formatting the front end

function getInfo($uniqueID) {

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

  $query = "SELECT * FROM userInfo WHERE username = $uniqueID;"

  // this is the output list that returns [username, first, last, email, city, state, birthdate]
  $outList = array();
  $result = mysqli_query($connect,$query);
  while ($row = $result->fetch_row()){
    array_push($outList, $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
  }
  return $outList
}

print <<<TEST
<html>



</html>
TEST;

?>
