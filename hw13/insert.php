<!DOCTYPE html>

<html>
<head>
<meta charset='UTF-8'>
<title> Assignment 13 </title>
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function checker() {
  lyst = ["id", "last", "first", "major", "gpa"];
  var filled = 0;
  for (var i = 0; i < lyst.length; i ++) {
    if ($("#" + lyst[i]).val() != "") {
      filled ++;
    }
  }
  if (filled == lyst.length) {
    return true
  }
  else {
    alert ("You need to fill in all fields.");
    return false;
  }
}
</script>
</head>
<body>

<?php
if (isset($_COOKIE["username"])) {
print <<<PAGE1
    <h1> Insert Student Records</h1>
    <form method='POST' id='form'  onsubmit='return checker()'>
    <table>
    <tr>
      <td>ID</td><td><input type='text' size='15' name='id' id='id'></td>
    </tr>
    <tr>
      <td>Last Name: </td><td><input type='text' size='15' name='last' id='last'></td>
    </tr>
    <tr>
      <td>First Name: </td><td><input type='text' size='15' name='first' id='first'></td>
    </tr>
    <tr>
      <td>Major: </td><td><input type='text' size='15' name='major' id='major'></td>
    </tr>
    <tr>
      <td>GPA: </td><td><input type='text' size='15' name='gpa' id='gpa'></td>
    </tr>
    <tr>
      <td><input type='submit' value='Insert'></td>
      <td><input type='reset' value='Clear'></td>
    </tr>
    </table>
    <br>
    <br>
    </form>
    <a href='./hw13.php'>Go back to main menu </a>
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

  $id = $_POST["id"];
  $last = $_POST["last"];
  $first = $_POST["first"];
  $major = $_POST["major"];
  $gpa = $_POST["gpa"];

  $stmt = mysqli_prepare ($connect, "INSERT INTO students VALUES (?, ?, ?, ?, ?)");
  mysqli_stmt_bind_param ($stmt, 'sssss', $id, $last, $first, $major, $gpa) or die("Failed: ". mysqli_error($connect));
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  echo "
    <p> Thank you for your submission. </p>
    </body>
    </html>";
}

?>
