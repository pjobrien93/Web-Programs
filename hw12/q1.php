

<?php
session_start();
$user = $_SESSION["user"];
if (isset($_COOKIE[$user])){
echo <<<QUES1
<html>
<head><title>Question 1</title>
<script type = "text/javascript" >
    history.pushState(null, null, 'q1.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'q1.php');
    });
    </script>
</head>
<body>
<form method = "post" action = "q2.php">
<b>1)</b> According to Kepler the orbit of the earth is a circle with
the sun at the center.
<p><input name = "one" type = "radio" value = "0" />True</p>
<p> <input name = "one" type = "radio" value = "1" />False</p>
<p><input type="submit" name="submit1" value="Submit" /></p>
</form>
</body>
</html>
QUES1;
}
else{
echo <<<ROUTE
<p>You have exceeded the 15 minute time limit before starting the quiz. Your quiz has been scored.</p>
<form method="post" action="endpage.php">
<p><input type="submit" name="timedout"  value="See Results"></p>
</form>
ROUTE;
}
?>
