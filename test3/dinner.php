<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="dinner.css">
<meta charset='UTF-8'>
<title>Patricia OBrien - Test 3</title>
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function check() {
  var name = document.getElementById("name").value;
  var item = document.getElementById("item").value;
  if (name == "" || item == "") {
    window.alert("Please fill out the all the fields!");
    return false;
  }
  else {
    return true;
  }
}
</script>
</head>
<body>
<header>
<h1>Potluck Dinner Signup Form</h1>
</header>

<div id="center">
<?php


// if the user is logged in and the cookie is set than he can view the form
if (isset($_COOKIE["username"])) {
  // Connect to the MySQL database
  $host = "fall-2015.cs.utexas.edu";
  $user = "pjobrien";
  $pwd = "wVwmZDXU8h";
  $dbs = "cs329e_pjobrien";
  $port = "3306";

  $connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

  if (empty($connect)){
    die("mysqli_connect failed: " . mysqli_connect_error());
  }
///////////////Print out the table///////////////////////

  echo "<table>";
  echo "<tr><td><b>Name</b></td><td><b>Item</b></td></tr>";
  $table = "dinner";
  $result = mysqli_query($connect, "SELECT * from $table");
  while ($row = $result->fetch_row()){
  echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
}
  echo "</table>";
  $result->free();

//////////////////Insert the new information///////////////

print <<<FRM
  </div>
  <div id="sub">
  <form method="POST" action="insert.php" onsubmit = "return check();">
  <table>
    <tr>
      <td>Name: </td>
      <td> <input type="text" name="nam" id="name" maxlength="20"> </td>
    </tr>
    <tr>
      <td>Item: </td>
      <td> <input type="text" name="item" id="item" maxlength="100"> </td>
    </tr>
    <tr>
      <td><input type="submit" value="Submit"></td>
      <td><input type="reset" value="Clear"></td>
    </tr>
  <table>
  </form>
  </div>
FRM;


}
// if the user is not logged in he cannot view the form
else {
print <<<ERRR
    <h2>You are not logged in!</h2>
    <a href="./login.html">Click here to go back to login page</a>
  </body>
  </html>
ERRR;
}

?>
