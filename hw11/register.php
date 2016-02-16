<?php
  $uname = $_POST["username"];
  $passwd = $_POST["password"];
  $dupFlag = false;

  // check that the username is not already there
  $ofile = fopen("passwd.txt", "r");
  while (!feof($ofile)){
    $line1 = trim(fgets($ofile));
    $name = explode(":", $line1);
    if ($name[0]==$uname) {
      $dupFlag = true;
    }
  fclose($outfile);
  }
  if (!$dupFlag) {
    $outfile = fopen("passwd.txt", "a");
    $output = $uname . ":" . $passwd. "\n\n";
    fwrite($outfile, $output);
    fclose($outfile);
    print <<<PAGE1
    <html>
    <head>
    <title>Quiz 17 - Patricia O'Brien </title>
    </head>
    <body>
    <h3>Thank you for registering!</h3>
    <p><a href="http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/hw11/hw11.php">Click here to go to read headlines</a></p>
    </body>
    </html>
PAGE1;
  } else {
      print <<<PAGE2
      <html>
      <head>
      <title>Assingment 11</title>
      </head>
      <body>
      <h3>Sorry that username is already taken. Please try a different one.</h3>
      <p><a href="http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/hw11/hw11.php">Click here to go back to the homepage.</a></p>
      </body>
      </html>
PAGE2;
  }
?>
