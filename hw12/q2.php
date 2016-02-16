

<?php
session_start();
$user = $_SESSION["user"];
if (isset($_COOKIE[$user])){
echo <<<QUES2
<html>
<head><title>Question 2</title>
<script type = "text/javascript" >
    history.pushState(null, null, 'q2.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'q2.php');
    });
    </script>
</head>
<body>
<form method = "post" action = "q3.php">
<b>2)</b> Ancient astronomers did consider the heliocentric model of
the solar system but rejected it because they could not detect parallax.
<p><input name = "two" type = "radio" value = "1" />True</p>
<p> <input name = "two" type = "radio" value = "0" />False</p>
<p><input type="submit" name="submit1" value="Submit" /></p>
</form>
</body>
</html>
QUES2;

$_SESSION["q1"] = $_POST["one"];
//echo "This should show 0 or 1";
//echo $_SESSION["q1"];

if($_SESSION["q1"] == "1"){
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

