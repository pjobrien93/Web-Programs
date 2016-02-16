<?php
session_start();
if (isset($_SESSION["user"]) && isset($_COOKIE["username"]))
{
$webuser = $_SESSION["user"];
$webuser = trim($webuser);


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
      </button>
      <a class="navbar-brand" href="homepage.php"><span class="glyphicon glyphicon-leaf"></span> Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./viewM.php"><span class="glyphicon glyphicon-envelope"></span></a></li>
        <li><a href="./homepage.php">Connect</a></li>
        <li><a href="./logout.php">Logout</a><li>
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
    <h3>Messages</h3>
TOP;
  // Connect to the MySQL database
$host = "fall-2015.cs.utexas.edu";
$user = "sadie";
$pwd = "b4kJT+nb8y";
$dbs = "cs329e_sadie";
$port = "3306";

$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

  echo "<table class='table table-striped'>";
  echo "<thead>";
  echo "<tr><td><b>Sender</b></td><td><b>Message</b></td><td><b>Send Your Info</b></td></tr>";
  echo "</thead>";
  $table = "MESSAGES";
  $result = mysqli_query($connect, "SELECT * from $table where receiver = '$webuser'");
  while ($row = $result->fetch_row()){
  echo "<tr><td>" . $row[0] . "</td><td>" . $row[2] . "</td>";
echo <<<YES
<td>
<form method="post" action="sendContactInfo.php">
<input type="submit" value="Send Contact Info"/>
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

</body>
</html>

BOTTOM;
// Close connection to the database
mysqli_close($connect);


}
else{
echo "<h2>Redirecting to home page, you must be logged in.</h2>";
header("refresh:2;url=homepage.php");
}

?>
