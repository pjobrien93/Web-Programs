<?php
if ($_COOKIE["username"]) {
  print <<<PAGE3
  <html>
<head>
   <title>Assignment 11</title>
</head>

<body>
  <header>
    <h1>The Austin Picayune</h1>
    <h4> Austin, TX &#9671; &#9671; &#9671; 17 November 2015</h4>
  </header>

  <div id="center">
    <ul>
      <li><h2><a href="./five.html">Best Places to Nap on Campus</a></h2></li>
      <li><h2><a href="./four.html">Campus Carry: The Only Way to Someone with a Gun is to Draw First</a></h2></li>
      <li><h2><a href="./three.html">Pro-Israeli Professor Eskimo Kisses Student in an Pro-Palestinian Protest</a></h2></li>
      <li><h2><a href="./two.html">Bevo to Be Served to Homless for Thanksgiving Dinner</a></h2></li>
      <li><h2><a href="./one.html">Students Protest High Tuition</a></h2></li>
    </ul>
  </div>
</body>
</html>
PAGE3;
} else {
    print <<<PAGE4
  <html>
<head>
   <title>Assignment 11</title>
</head>

<body>
  <header>
    <h1>The Austin Picayune</h1>
    <h4> Austin, TX &#9671; &#9671; &#9671; 17 November 2015</h4>
  </header>

  <div id="center">
    <ul>
      <li><h2><a href="./blank.html">Best Places to Nap on Campus</a></h2></li>
      <li><h2><a href="./blank.html">Campus Carry: The Only Way to Someone with a Gun is to Draw First</a></h2></li>
      <li><h2><a href="./blank.html">Pro-Israeli Professor Eskimo Kisses Student in an Pro-Palestinian Protest</a></h2></li>
      <li><h2><a href="./blank.html">Bevo to Be Served to Homless for Thanksgiving Dinner</a></h2></li>
      <li><h2><a href="./blank.html">Students Protest High Tuition</a></h2></li>
    </ul>
  </div>
<form method = "post"
      action = "./register.php">
  <div id="register">
    <h3>Register</h3>
    Username: <td><input type="text" name="username"></td>
    Password: <td><input type="password" name="password"></td>
    <td><input type="submit" value="Register"></td>
  </div>
</form>
<form method = "post"
      action = "./login.php">
  <div id="login">
    <h3>Login</h3>
    Username: <td><input type="text" name="username"></td>
    Password: <td><input type="password" name="password"></td>
    <td><input type="submit" value="Login"></td>
  </div>
</form>


</body>
</html>

PAGE4;
}
