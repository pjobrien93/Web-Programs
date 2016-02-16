<?php
session_start();
if (isset($_SESSION["user"]) && isset($_COOKIE["username"]))
{
$sender = $_SESSION["user"];
/*print <<<TOP
<html>
<head>
<title> Message Sent </title>
</head>
<body>
<h3>  </h3>
TOP;
*/
// Connect to the MySQL database
$host = "fall-2015.cs.utexas.edu";
$user = "sadie";
$pwd = "b4kJT+nb8y";
$dbs = "cs329e_sadie";
$port = "3306";

$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

if (empty($connect))
{
  die("mysqli_connect failed: " . mysqli_connect_error());
}

//print "Connected to ". mysqli_get_host_info($connect) . "<br /><br />\n";

// Add data to a table in the database
//$sender = $sender;
$receiver = $_POST["receiverf"];
$message = $_POST["messagef"];

$stmt = mysqli_prepare ($connect, "INSERT INTO MESSAGES VALUES (?, ?, ?)");
mysqli_stmt_bind_param ($stmt, 'sss', $sender, $receiver, $message);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

/*
// Check if the data has been added properly to the table in the database
$result = mysqli_query($connect, "SELECT * from MESSAGES");
while ($row = $result->fetch_row())
{
  print "ID = " . $row[0] . " LastName = " . $row[1] . " FirstName = " . $row[2].
        "<br /><br />\n";
}
$result->free();
*/
// Close connection to the database
mysqli_close($connect);

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
    <h3>Your message has been sent!</h3>
TOP;

print <<<BOTTOM
    <p></p>
  </div>
</div>
</div>

</body>
</html>

BOTTOM;

}
else{
echo "<h2>Redirecting to home page, you must be logged in.</h2>";
header("refresh:2;url=homepage.php");
}



?>

