<?php
if (isset($_COOKIE["username"])) {

$id = $_POST["id"];
$id = trim($id);
$last = $_POST["last"];
$last = trim($last);
$first = $_POST["first"];
$first = trim($first);
//echo $id;
//echo $last;
//echo $first;
$idfilled = true;
$lastfilled = true;
$firstfilled = true;
if ($id == null){$idfilled = false;}
if ($last == null){$lastfilled = false;}
if ($first == null){$firstfilled = false;}

print <<<TOP
<html>
<head>
<title> Assignment 13 </title>
</head>
<body>
  <h1> View Student Records</h1>

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


// Get data from a table in the database and print it out
$query = "";
$table = "students";
$idcol = "id";
$lastcol = "lastName";
$firstcol = "firstName";
if ($idfilled)
{
echo "Result for students with ID $id are shown below.<br/><br/>";
$query = "select * from $table where $idcol=\"$id\"";
}
if (!$idfilled && $lastfilled && $firstfilled){
$query = "select * from $table where $lastcol=\"$last\" and $firstcol=\"$first\"";
//print $query;
}
if (!$idfilled && !$lastfilled && $firstfilled){
$query = "select * from $table where $firstcol = \"$first\"";
}
if (!$idfilled && $lastfilled && !$firstfilled){
$query = "select * from $table where $lastcol = \"$last\"";
}

$result = mysqli_query($connect,$query);
while ($row = $result->fetch_row()){
$toprint = "ID = " . $row[0] . " | Last Name = " . $row[1] . " | First Name = " . $row[2].
        " | Major = " . $row[3] . " | GPA = " . $row[4] . "<br />\n";

}
if($toprint){
print $toprint;
}
else{
print "No results<br/>";
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
