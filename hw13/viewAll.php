<?php
if (isset($_COOKIE["username"])) {

print <<<TOP
<html>
<head>
<title> Assignment 13 </title>
</head>
<body>
<h1>View Student Records</h1>
TOP;

// Connect to the MySQL database
$host = "fall-2015.cs.utexas.edu";
$user = "pjobrien";
$pwd = "wVwmZDXU8h";
$dbs = "cs329e_pjobrien";
$port = "3306";

$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

if (empty($connect))
{
  die("mysqli_connect failed: " . mysqli_connect_error());
}

print "Connected to ". mysqli_get_host_info($connect) . "<br />\n";

// Get data from a table in the database and print it out

$table = "students";
$result = mysqli_query($connect, "SELECT * from $table");
while ($row = $result->fetch_row())
{
  print "ID = " . $row[0] . " | Last Name = " . $row[1] . " | First Name = " . $row[2].
        "|  Major = " . $row[3] . " | GPA = " . $row[4] . "<br /><br />\n";
}

$result->free();


print <<<MID
  <form method="POST" action="./view.php">
    <input type="submit" name="viewMenu" value="View More">
  </form>
  <form method="POST" action="./hw13.php">
    <input type="submit" name="mainMenu" value="Main Menu">
  </form>
MID;

// Close connection to the database
mysqli_close($connect);

print <<<BOTTOM
</body>
</html>
BOTTOM;
}
else {
print <<<ERRR
  <html>
  <head>
  <title>Assignment 13</title>
  </head>
  <body>
    <h2>You are not logged in!</h2>
    <a href="./login.html">Click here to go back to login page</a>
  </body>>
  </html>
ERRR;
}

?>
