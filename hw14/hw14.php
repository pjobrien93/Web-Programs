<?php
// get the q parameter from URL
$username = $_POST['username'];
$password = $_POST['password'];

// encrypt the password
$encrypt = crypt($password);

// open passwd file and see if the username already exists

$file = fopen ("./passwd.txt", "r");
$takenFlag = false;

while (!feof($file))
{
  $line = trim(fgets($file));
  $arr = explode(":", $line);
  $curUname = $arr[0];
  if ($username == $curUname) {
    $takenFlag = true;
  }
}
fclose ($file);

if ($takenFlag == false){
  $file = fopen ("./passwd.txt", "a");
  $newLine = $username .":". $encrypt."\n";
  fwrite($file, $newLine);
  fclose ($file);
  header('Location: http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/hw14/success.html');
} 
else {
  header('Location: http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/hw14/blank.html');
}

?>
