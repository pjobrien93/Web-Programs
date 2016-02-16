<?php
session_start();
if (isset($_SESSION["user"]))
{
$webuser = $_SESSION["user"];
$webuser = trim($webuser);

print <<<TOP
<html>
<head>
<title> Inbox </title>
</head>
<body>
<h3> Messages </h3>
TOP;

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


$table='MESSAGES';
/*$stmt = mysqli_prepare ($connect, "SELECT * FROM ? WHERE receiver = ?");
mysqli_stmt_bind_param ($stmt, 'ss', $table, $webuser);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
*/
// Check if the data has been added properly to the table in the database

//echo $webuser;
$result = mysqli_query($connect, "SELECT * from MESSAGES WHERE receiver = '$webuser'");
while ($row = $result->fetch_row())
{
 print "User: " . $row[0] . "<br/>";
 print "Message: " . $row[2] . "<br/>";
 //$tosend = $row[0] . "send"; 
 //$_SESSION[$tosend] = false;
 //$idfor = "unique"; 
echo <<<SEND
 
 <form method="post" action="sendContactInfo.php">
 <input type="hidden" name="name" value=$row[0]>
 <input id="unique" type="submit" value="Send Contact Info to $row[0]"/>  
 </form>
  

SEND;
}
$result->free();

// Close connection to the database
mysqli_close($connect);

print <<<BOTTOM
 
<button onclick="location.href = 'homepage.php';">Return to Home</button>

</body>
</html>
BOTTOM;
}
else{
echo <<<HTML
You must login to Insert Student Records.
<p><button onclick="location.href = 'loginsignup.html';">Login</button></p>
HTML;

}


?>
