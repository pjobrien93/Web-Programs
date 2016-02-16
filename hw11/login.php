<?php
  $uname = $_POST["username"];
  $pass = $_POST["password"];
  $loginFlag = false;

  $ofile = fopen("passwd.txt", "r");
  while (!feof($ofile)){
    $line1 = trim(fgets($ofile));
    $target = $uname . ":" . $pass;
    if ($line1 == $target) {
      $loginFlag = true;
      // set the cookie
      setcookie ("username", $uname, time()+120);
    }
  }
if ($loginFlag) {
  print <<<PAGE5
  <html>
  <body>
  <h1>Login was successful!</h1>
  <p>
    <a href="http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/hw11/hw11.php">Click here to read the headlines!</a>
  </p>

  </body>
  </html>
PAGE5;

} else {
  print <<<PAGE6
  <html>
  <body>
  <h1>Login was not successful. Please Try again</h1>
  <p>
    <a href="http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/hw11/hw11.php">Click here to go back to homepage.</a>
  </p>
  </body>
  </html>
PAGE6;
}
?>
