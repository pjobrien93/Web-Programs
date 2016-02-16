<?php

// Connect to the MySQL database
$host = "fall-2015.cs.utexas.edu";
$user = "pjobrien";
$pwd = "wVwmZDXU8h";
$dbs = "cs329e_pjobrien";
$connect = mysqli_connect($host, $user, $pwd, $dbs);
//Check that connection was successful
if (empty($connect))
{
  die("mysqli_connect failed: " . mysqli_connect_error());
}

if (isset($_COOKIE["username"])) {
print <<<PAGE1
  <html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  function check() {
    var filled = 0;
    if ($("#id").val() != "") {   // if ID form is filled
      var elments = ["last", "first", "major", "gpa"];
      for (var i = 0; i < elements.length; i++) { 
        if ($("#" + elements[i]).val() != "") {
          filled ++;
        }
      }
    }
    if (filled > 0) {
      return true;
    }
    else {
      alert ("ID and one other text field must be filled.");
      return false;
    }
  } 
  </script>  
  <title> Assignment 13 </title>
  </head>
  <body>
  <h1> Update Student Records</h1>
  <form id="update" method="post" onsubmit="check()">
    <table>
      <tr>
        <td>ID</td>
        <td><input type="text" name="id"></td>
      </tr>
      <tr>
        <td>Last Name: </td>
        <td><input type="text" name="last"></td>
      </tr>
      <tr>
        <td>First Name: </td>
        <td><input type="text" name="first"></td>
      </tr>
      <tr>
        <td>Major: </td>
        <td><input type="text" name="major"></td>
      </tr>
      <tr>
        <td>GPA: </td>
        <td><input type="text" name="gpa"></td>
      </tr>
      <tr>
        <td><input type="submit" name ='submit' value="Submit"></td>
        <td><input type="reset" value="Reset"></td>
      </tr>
    </table>
    <br>
    <br>
    <a href="./hw13.php">Go back to the main menu</a>
  </form>
PAGE1;
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

if (isset($_POST["id"])) {
  // Connect to the MySQL database
  $host = "fall-2015.cs.utexas.edu";
  $user = "pjobrien";
  $file = fopen("/u/pjobrien/password.txt", "r");
  $line = fgets ($file);
  $pwd = trim ($line);
  fclose ($file);
  $dbs = "cs329e_pjobrien";
  $port = "3306";

  $connect = mysqli_connect($host, $user, $pwd, $dbs, $port);

  if (empty($connect)) {
    die("mysql_connect failed " . mysqli_connect_error());
  }
  // Add data to a table in the database

  $id = $_POST["id"];
  $last = $_POST["last"];
  $first = $_POST["first"];
  $major = $_POST["major"];
  $gpa = $_POST["gpa"];
  $changeID = true;
  $changeLAST = true;
  $changeFIRST = true;
  $changeMAJOR = true;
  $changeGPA = true;

  if ($last==""){
  $changeLAST = false;
  }
  if ($first==""){
  $changeFIRST = false;
  }
  if ($major==""){
  $changeMAJOR = false;
  }
  if ($gpa==""){
  $changeGPA = false;
  }

	if ($changeLAST){
	$stmt = mysqli_prepare ($connect, "UPDATE students SET lastName = ? WHERE id= ?");
	mysqli_stmt_bind_param ($stmt, 'ss', $last, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	}
	if ($changeFIRST){
	$stmt = mysqli_prepare ($connect, "UPDATE students SET firstName = ? WHERE id= ?");
	mysqli_stmt_bind_param ($stmt, 'ss', $first, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	}
	if ($changeMAJOR){
	$stmt = mysqli_prepare ($connect, "UPDATE students SET major = ? WHERE id= ?");
	mysqli_stmt_bind_param ($stmt, 'ss', $major, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	}
	if ($changeGPA){
	$stmt = mysqli_prepare ($connect, "UPDATE students SET gpa = ? WHERE id= ?");
	mysqli_stmt_bind_param ($stmt, 'ss', $gpa, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	}
	// Close connection to the database
	mysqli_close($connect);

  echo "
    <p> Thank you for your submission. </p>
    </body>
    </html>";
}

?>
