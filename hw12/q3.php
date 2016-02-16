

<?php
session_start();
$user = $_SESSION["user"];
if (isset($_COOKIE[$user])){
echo <<<QUES3
<html>
<head><title>Question 3</title>
<script type = "text/javascript" >
    history.pushState(null, null, 'q3.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'q3.php');
    });
    </script>
</head>
<body>
<form method = "post" action = "q4.php">
<b>3)</b> The total amount of energy that a star emits is directly related
to its <br>
<label> <input name = "three" type = "radio" value = "0" />surface gravity and magnetic field </label>
<br>
<label> <input name = "three" type = "radio" value = "1" />radius and temperature</label>
<br>
<label> <input name = "three" type = "radio" value = "0" />pressure and volume</label>
<br>
<label> <input name = "three" type = "radio" value = "0" />location and velocity</label>
<br><p><input type="submit" name="submit3" value="Submit" /></p>
</form>
</body>
</html>
QUES3;

$_SESSION["q2"] = $_POST["two"];
//echo "This should show 0 or 1";
//echo $_SESSION["q2"];

if($_SESSION["q2"] == "1"){
$_SESSION["correct"] = $_SESSION["correct"] + 1;
}


}

else{
echo <<<ROUTE
<p>You have exceeded the 15 minute time limit before submitting the previous question. Your quiz has been scored.</p>
<form method="post" action="endpage.php">
<p><input type="submit" name="timedout"  value="See Results"></p>
</form>
ROUTE;
}

?>

