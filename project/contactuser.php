<?php
session_start();

if (isset($_SESSION["user"]) && isset($_COOKIE["username"])){
$webuser = $_SESSION["user"];
$sendto = ($_POST["name"]);
//echo $sendto;

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

$table = 'userInfo';


// Check if the data has been added properly to the table in the database
$result = mysqli_query($connect, "SELECT username from $table");
while ($row = $result->fetch_row())
{
}
$result->free();

// Close connection to the database
mysqli_close($connect);

echo <<<CONT
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact User - DanceSportConnect</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
function validateIt(){
var receiver = document.getElementById("conform").receiverf.value;
var message = document.getElementById("conform").messagef.value;
if ((receiver == "") || (message == "")){
window.alert("Please enter a receiver and message");
return false;
}
}
</script>
</head>
<body>

<div class="container">
  <h2>Request Contact Information</h2>
  <form role="form" id="conform" method="post" action="insertMessage.php" onsubmit="return validateIt();">
    <div class="form-group">
      <label for="email">Username of recipient:</label>
      <input type="text" class="form-control" name="receiverf" id="receiverf" value=$sendto>
    </div>
    <div class="form-group">
      <label for="pwd">Message:</label>
      <input style="height:50px"  type="text" name="messagef" id="messagef" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
    <button type="reset" class="btn btn-default">Reset</button>
  </form>
</div>
</body>
</html>

CONT;

}
else{
echo "<h2>Redirecting to home page, you must be logged in.</h2>";
header("refresh:2;url=homepage.php");
}

?>
