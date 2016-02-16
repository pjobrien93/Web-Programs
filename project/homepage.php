<?php
session_start();

if (isset($_COOKIE["username"]) && isset($_SESSION["user"])) {

//get the users in the database
  // Connect to the MySQL database
  $host = "fall-2015.cs.utexas.edu";
  $user = "sadie";
  $pwd = "b4kJT+nb8y";
  $dbs = "cs329e_sadie";
  $port = "3306";

  $connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

  if (empty($connect)){
    die("mysqli_connect failed: " . mysqli_connect_error());
  }

 /* echo "<table>";
  echo "<tr><td><b>Name</b></td><td><b>Item</b></td></tr>";
  $table = "dinner";
  $result = mysqli_query($connect, "SELECT * from $table");
  while ($row = $result->fetch_row()){
  echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
}
  echo "</table>";
  $result->free();*/


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

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="homepage.php"><span class="glyphicon glyphicon-leaf"></span> Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./viewM.php"><span class="glyphicon glyphicon-envelope"></span></a></li>
        <li><a href="#connect">Connect</a></li>
        <li><a href="./logout.php">Logout</a><li>
        <li><a href="#links">Links</a><li>
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
<div id="connect">
  <div class="jumbotron">
    <h3>Dancers In Your Area</h3>
TOP;

  echo "<table class='table table-striped'>";
  echo "<thead>";
  echo "<tr><td><b>Username</b></td><td><b>Location</b></td><td><b>Dance Styles</b></td><td><b>Dance Position</b></td><td><b>Contact</b></td></tr>";
  echo "</thead>";
  $table = "userInfo";
  $result = mysqli_query($connect, "SELECT * from $table");
  while ($row = $result->fetch_row()){
  echo "<tr><td>" . $row[0] . "</td><td>" . $row[6] .", ".$row[7]. "</td><td>".$row[8] ."</td><td>" .$row[9]. "</td>";
echo <<<YES
<td>
<form method="post" action="contactuser.php">
<input type="submit" value="Contact"/>
<input name="name" type="hidden" value=$row[0]>
</form></td></tr>
YES;
}
  echo "</table>";
  $result->free();

print <<<BOTTOM
    <p></p>
  </div>
</div>
</div>

<div class="container">
<div id="links">
  <div class="jumbotron">
    <h3>Links</h3>
    <a href="https://www.worlddancesport.org/">Dancesport Federation</a>
    <p>This website tells you all about the rules for various dance styles.</p>
    <br>
    <a href="http://www.texasballroom.org/">University of Texas Ballroom Team</a>
    <p>This is the homepage of the University of Texas Ballroom team. You can see their practice schedule and find out about the team.</p>
  </div>
</div>
</div>



</body>
</html>

BOTTOM;

}
else {
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
      <a class="navbar-brand" href="./homepage.php"><span class="glyphicon glyphicon-leaf"></span> Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#about">About<span class="sr-only">(current)</span></a></li>
        <li><a href="#connect">Connect</a></li>
        <li><a href="#links">Links</a><li>
        <li><a href="./loginsignup.html">Login</a><li>
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
<div id="links">
  <div class="jumbotron">
    <h3>Links</h3>
    <a href="https://www.worlddancesport.org/">Dancesport Federation</a>
    <p>This website tells you all about the rules for various dance styles.</p>
    <br>
    <a href="http://www.texasballroom.org/">University of Texas Ballroom Team</a>
    <p>This is the homepage of the University of Texas Ballroom team. You can see their practice schedule and find out about the team.</p>
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
