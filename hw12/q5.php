

<?php
session_start();
$user = $_SESSION["user"];
if (isset($_COOKIE[$user])){
echo <<<QUES5
<html>
<head><title>Question 5</title>
<script type = "text/javascript" >
    history.pushState(null, null, 'q5.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'q5.php');
    });
    </script>
</head>
<body>
<form method = "post" action = "q6.php">
<b>5)</b> A collection of a hundred billion stars, gas, and dust is
called a <input name = "five" type = "text" size = "12" value=""/>.
<br><p><input type="submit" name="submit5" value="Submit" /></p>
</form>
</body>
</html>
QUES5;

$_SESSION["q4"] = $_POST["four"];
//echo "This should show 0 or 1";
//echo $_SESSION["q4"];

if($_SESSION["q4"] == "1"){
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

