<?php
session_start();

$user = $_POST["username"];
$pass = $_POST["password"];

$_SESSION["user"] = $user;

echo <<<TOP
<html>
<head><title>Login</title>
</head>
<body>


TOP;

$flagin = false;
$enpass = md5($pass);
//$encpass = crypt($pass);
$file = fopen("passwd.txt","r");

while(!feof($file))
{
$line = fgets($file);
$arr1 = explode (":",$line);
$usercheck = $arr1[0];
$passcheck = $arr1[1];
$usercheck = trim($usercheck);
$passcheck = trim($passcheck);

if (($user == $usercheck) && ($enpass == $passcheck) && ($user!=""))
{
$flagin = true;
}
}
fclose($file);

if ($flagin){

   print <<<TOP

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DanceSport Connect</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="page-header">
  <h1>DanceSport Connect <small>A place to connect with ballroom dancers in your area</small></h1>
</div>



<div class="container">
<div id="connect">
  <div class="jumbotron">
    <h3>Login Successful!</h3><br/>
<p> Redirecting to your portal in 5 seconds.</p>
TOP;

print <<<BOTTOM
    <p></p>
  </div>
</div>
</div>

</body>
</html>

BOTTOM;






setcookie ("username", $user, time()+900);
//setcookie($user,$pass,time()+900,"/","cs.utexas.edu",0);

// take to homepage in 5 seconds
header( "refresh:3;url=./homepage.php" );
}






else{

   print <<<TOP

<!DOCTYPE html>
<html lang="en">
<head>
  <title>DanceSport Connect</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="page-header">
  <h1>DanceSport Connect <small>A place to connect with ballroom dancers in your area</small></h1>
</div>



<div class="container">
<div id="connect">
  <div class="jumbotron">
    <h3>Login Failed.</h3><br/>
<p> Redirecting to home page in 5 seconds.</p>
TOP;

print <<<BOTTOM
    <p></p>
  </div>
</div>
</div>

</body>
</html>

BOTTOM;



// destroy session
session_destroy();

//take back to login page after 5 seconds
header( "refresh:3;url=./homepage.php" );
}
echo "</body>";
echo "</html>"

?>
