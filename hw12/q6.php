

<?php
session_start();
$user = $_SESSION["user"];
if (isset($_COOKIE[$user])){
echo <<<QUES6
<html>
<head><title>Question 6</title>
<script type = "text/javascript" >
    history.pushState(null, null, 'q6.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'q6.php');
    });
    </script>
</head>
<body>
<form method = "post" action = "endpage.php">
<b>6)</b> The inverse of the Hubble's constant is a measure of the
<input name = "six" type = "text" size = "12" value=""/> of the universe. <br>
<p><input type="submit" name="submit6" value="Submit" /></p>
</form>
</body>
</html>
QUES6;

$_SESSION["q5"] = $_POST["five"];
//echo "This should show what you inputted";
//echo $_SESSION["q5"];

if($_SESSION["q5"] == "galaxy"){
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

