<?php
// check if the username is taken
$username = $_POST['username1'];
$file = fopen ("./passwd.txt", "r");
$takenFlag = false;

while (!feof($file))
{
  $line = trim(fgets($file));
  $arr = explode(":", $line);
  //echo $username;
  $curUname = $arr[0];
  //echo $curUname;
  //echo "<br/>";
  if ($username == $curUname) {
    $takenFlag = true;
    
  }
}
fclose ($file);


if ($takenFlag){
         print <<<TAKEN
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

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="homepage.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
         <form class="navbar-form navbar-left" role="search">
         <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
         </div>
         <button type="submit" class="btn btn-default">Submit</button>
         </form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
<div id="about">
  <div class="jumbotron">
    <h4>$username is already taken. Please try again.</h4>
  </div>
</div>
</div>

<div class="container">
<div id="login">
  <div class="jumbotron">
      <h3>Register</h3>
      <a href="./register.html">
      <button>Create Account!</button>
      </a>
  </div>
</div>
</div>

</body>
</html>
TAKEN;

}
else{
// Connect to the MySQL database

$host = "fall-2015.cs.utexas.edu";
//$user = "pjobrien";
$user = "sadie";
//$file = fopen("/u/pjobrien/password.txt", "r");
//$line = fgets ($file);
//$pwd = trim ($line);
$pwd = "b4kJT+nb8y";
//fclose ($file);
//$dbs = "cs329e_pjobrien";
$dbs = cs329e_sadie;
$port = "3306";

$connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

if (empty($connect)) {
  die("mysql_connect failed " . mysqli_connect_error());
}

// get all the other fields from the form
$password = $_POST['password'];
// encrypt password
$password = md5($password);
$first = $_POST["first"];
$last = $_POST["last"];
$phone = $_POST['phone'];
$email = $_POST["email"];
$city = $_POST["city"];
$state = $_POST["state"];
$style = $_POST['style'];
$pos = $_POST['pos'];
$bio = $_POST['bio'];

$styleStr = "";
$n = count($style);
for($i=0; $i < $n; $i++){
  $styleStr .= $style[$i].",";
}
trim($styleStr, ",");

//only write if the username is not taken

  // only write if the required values are filled
  if ($username!="" && $password!="" && $first!="" && $last!="" && $phone!="" && $email!="" && $city!="" && $state!="") {
    $stmt = mysqli_prepare ($connect, "INSERT INTO userInfo VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param ($stmt, 'sssssssssss', $username, $password, $first, $last, $email, $phone, $city, $state, $styleStr, $pos, $bio) or die("Failed: ". mysqli_error($connect));
    mysqli_stmt_execute($stmt);

    // write new username:encrypted(password) pair to text file
    $myfile = fopen("./passwd.txt", "a");
    $newLine = $username. ":" . $password . "\n";
    fwrite($myfile, $newLine);
    fclose ($myfile);


mysqli_stmt_close($stmt);
//header('Location: http://zweb.cs.utexas.edu/users/cs329e-fa15/sadie/project/compiled/loginsignup.html');
}



      print <<<LOGGEDOUT
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

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="homepage.php">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#about">About<span class="sr-only">(current)</span></a></li>
        <li><a href="#connect">Connect</a></li>
        <li><a href="loginsignup.html">Login</a><li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
         <form class="navbar-form navbar-left" role="search">
         <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
         </div>
         <button type="submit" class="btn btn-default">Submit</button>
         </form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
<div id="about">
  <div class="jumbotron">
    <h2>You have succesfully registered! Please login.</h2>
  </div>
</div>
</div>

<div class="container">
<div id="about">
  <div class="jumbotron">
    <h3>About</h3>
    <p>You can meet other dancers in your area on DanceSport Connect. You can find a leader or a follower, dancers who dance your style, dancers who are in your area.</p>
  </div>
</div>
</div>
<div class="container">
<div id="connect">
  <div class="jumbotron">
    <h3>Dancer In Your Area</h3>
    <p>In order to use this feature, you must be logged in.</p>
  </div>
</div>
</div>
<div class="container">
<div id="login">
  <div class="jumbotron">
    <h3>Sign In!</h3>
      <a href="./loginsignup.html">
      <button>Sign In</button>
      </a>
      <h3>Don't have an account yet?</h3>
      <a href="./register.html">
      <button>Create Account!</button>
      </a>
  </div>
</div>
</div>

</body>
</html>
LOGGEDOUT;


}

?>
