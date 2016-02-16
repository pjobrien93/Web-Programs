<?php

//grab username from form
$uname = $_POST["username"];
$uname = trim($uname);

// open passwd file and see if the username already exists
$file = fopen ("./passwd.txt", "r");
$takenFlag = false;

while (!feof($file))
{
  $line = trim(fgets($file));
  $arr = explode(":", $line);
  $curUname = $arr[0];
  if ($uname == $curUname) {
    $takenFlag = true;
  }
}
fclose ($file);

if ($takenFlag) {
  echo "false";
}

?>
