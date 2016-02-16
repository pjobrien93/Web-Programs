<?php

$username = $_POST["uname"];
$password = $_POST["pword"];

$loginFlag = false;
    
$ofile = fopen("/u/z/users/cs329e-fa15/pjobrien/dbase/passwd", "r");
while (!feof($ofile)){
  $line = trim(fgets($ofile));
  $target = $username . ":" . $password;
  if ($line == $target) {
    $loginFlag = true;
    setcookie ("username", $username, time()+24*3600);
  }
}

fclose($ofile);


if (isset($_COOKIE["username"])) {

print <<<PAGE2
  <html>
  <head>
  <title>Assignment 13</title>
  </head>
  <body>
    <h2>Login Successful! You can edit or view your records.</h2>
    <table>
    <tr><td><form method="POST" action="./insert.php"><button type="submit" value="insert">Insert Records</form></td></tr>
    <tr><td><form method="POST" action="./update.php"><button type="submit" value="update">Update Records</form></td></tr>
    <tr><td><form method="POST" action="./delete.php"><button type="submit" value="delete">Delete Records</form></td></tr>
    <tr><td><form method="POST" action="./view.php"><button type="submit" value="view">View Records</form></td></tr>
    <tr><td><form method="POST" action="./logout.php"><button type="submit" value="logout">Logout</form></td></tr>
    </table>
  </body>
  </html>
PAGE2;

}
else {
print <<<ERRR
  <html>
  <head>
  <title>Assignment 13</title>
  </head>
  <body>
    <h2>Sorry, login was unsuccessful!</h2>
    <a href="./login.html">Click here to go back to login page</a>
  </body>>
  </html>
ERRR;
}

?>
