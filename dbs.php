<?php

print <<<TOP
<html>
<head>
<title> Database Access </title>
</head>
<body>
<h3> Database Access </h3>
TOP;

// Read in password
$file = fopen("/u/pjobrien/password.txt","r");
$line = fgets($file);
$line = trim($line);
fclose($file);

// Connect to the MySQL database
$host = "fall-2015.cs.utexas.edu";
$user = "pjobrien";
$pwd = $line;
$dbs = "cs329e_pjobrien";
$port = "3306";

$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

if (empty($connect))
{
  die("mysqli_connect failed: " . mysqli_connect_error());
}

print "Connected to ". mysqli_get_host_info($connect) . "<br /><br />\n";

// Get data from a table in the database and print it out

$table = "students";
$result = mysqli_query($connect, "SELECT * from $table");
while ($row = $result->fetch_row())
{
  print "LastName = " . $row[0] . " FirstName = " . $row[1].
	" Major = " . $row[2] . " Birthday = " . $row[3] . "<br /><br />\n";
}

$result->free();

// Add data to a table in the database
$last = "Mouse";
$first = "Mickey";
$major = "Song";
$bDay = "1928-11-18";

$stmt = mysqli_prepare ($connect, "INSERT INTO $table VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param ($stmt, 'ssss', $last, $first, $major, $bDay);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Check if the data has been added properly to the table in the database
$result = mysqli_query($connect, "SELECT * from $table");
while ($row = $result->fetch_row())
{
  print "LastName = " . $row[0] . " FirstName = " . $row[1].
	" Major = " . $row[2] . " Birthday = " . $row[3] . "<br /><br />\n";
}
$result->free();

// Delete the data just added. Remember to escape the double quotes.
// There are two ways of doing it. This is the first way.
$last = mysqli_real_escape_string($connect, $last);
mysqli_query($connect, "DELETE FROM $table WHERE lastName='$last'");


// This is the second way of escaping double quotes
mysqli_query($connect, "DELETE FROM $table WHERE lastName=\"$last\"");

// Print out the number of rows deleted.
print "Rows deleted: " . mysqli_affected_rows($connect) . "<br/><br />\n"; 
// Make sure that the data was actually deleted
$result = mysqli_query($connect, "SELECT * from $table");
while ($row = $result->fetch_row())
{
  print "LastName = " . $row[0] . " FirstName = " . $row[1].
	" Major = " . $row[2] . " Birthday = " . $row[3] . "<br /><br />\n";
}
$result->free();

// Close connection to the database
mysqli_close($connect);

print <<<BOTTOM
</body>
</html>
BOTTOM;
?>
