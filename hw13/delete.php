<?php

if (isset($_COOKIE["username"])) {
print <<<PAGE1
  <html>
  <head>
  <meta charset='UTF-8'>
  <title> Assignment 13 </title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>
  function checker() {
    if ($(":text").val() == "") {
      alert ("Please fill in the ID field");
      return false;
    }
    else {
      return true;
    }
  }
  </script>
  </head>
  <body>
      <h1> Delete Student Records</h1>
      <form method='POST' onsubmit='return checker()' id='form'>
      <table>
      <tr>
        <td>ID</td><td><input type='text' size='15' name='id' id='id'></td>
      </tr>
      <tr>
        <td><input type='submit' value='Delete'></td>
        <td><input type='reset' value='Reset'></td>
      </tr>
      </table>
      </form>
      <br>
      <br>
      <a href='./hw13.php'> Go back to main menu</a>
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

  $stmt = mysqli_prepare ($connect, "DELETE FROM students WHERE ID = ?");
  mysqli_stmt_bind_param ($stmt, 'i', $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  echo "
    <p>Thank you for your submission. <p>
    </body>
    </html>";
}

?>
