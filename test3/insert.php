<?php

  // do not trust input data
  function purge ($str)
  {
    $purged_str = preg_replace("/\W/", "", $str);
    return $purged_str;
  }


if (isset($_COOKIE["username"])) {
  $host = "fall-2015.cs.utexas.edu";
  $user = "pjobrien"; 
  $dbs = "cs329e_pjobrien";
  $port = "3306";
  $pwd = "wVwmZDXU8h";
  $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

  if (empty($connect)) {
    die("mysql_connect failed " . mysqli_connect_error());
  }

  $name = purge($_POST["nam"]);
  $item = purge($_POST["item"]);
  $name = trim($name);
  $item = trim($item);

  if ($name != "" && $item != "") {
    $stmt = mysqli_prepare ($connect, "INSERT INTO dinner VALUES (?, ?)");
    mysqli_stmt_bind_param ($stmt, 'ss', $name, $item)  or die("Failed: ". mysqli_error($connect));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
  setcookie("username", "", time() - 3600);
  header('Location: http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/test3/thanks.html');  

}
else {
print <<<ERRR
  <html>
  <head>
  <title>Assignment 13</title>
  </head>
  <body>
    <h2>You are not logged in!</h2>
    <a href="./login.html">Click here to go back to login page</a>
  </body>>
  </html>
ERRR;
}
?>
