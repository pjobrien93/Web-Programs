<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title> Assignment 13 </title>
<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function checker() {
  if ($(":text").val() == "") {
    alert ("Please fill in all the fields.");
    return false;
  }
  else {
    return true;
  }
}
</script>
</head>
<body>

<?php

if (isset($_COOKIE["username"])) {
print <<<PAGE1
  <h1>View Student Records</h1>
  <form method='POST' action="./viewSome.php" onsubmit='return checker()' id='form'>
    <table>
    <tr>
      <td>ID</td><td><input type='text' size='15' name='id' id='id'></td>
    </tr>
    <tr>
      <td>Last Name</td><td><input type='text' size='15' name='last' id='last'></td>
    </tr>
    <tr>
      <td>First Name</td><td><input type='text' size='15' name='first' id='first'></td>
    </tr>
    <tr>
      <td><input type='submit' value='Search Records' name="search"></td>
      <td><input type='reset' value='Clear'></td>
    </tr>
    </table>
    </form>
    <form method = 'POST' action ='./viewAll.php'>
    <input type = 'submit' value = 'View All Student Records' name = 'all'>
    </form>
    <br>
    <br>
    <a href='./hw13.php'> Go back to main menu </a>
  </body>
  </html>
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
?>
