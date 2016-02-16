

<?php
session_start();
$user = $_SESSION["user"];
if (isset($_COOKIE[$user])){
echo <<<QUES4
<html>
<head><title>Question 4</title>
<script type = "text/javascript" >
    history.pushState(null, null, 'q4.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'q4.php');
    });
    </script>
</head>
<body>
<form method = "post" action = "q5.php">

<b>4)</b> Stars that live the longest have <br>
<label><input name = "four" type = "radio" value = "0" />high mass</label>
<br>
<label><input name = "four" type = "radio" value = "0" />high temperature</label>
<br>
<label> <input name = "four" type = "radio" value = "0" />lots of hydrogen</label>
<br>
<label><input name = "four" type = "radio" value = "1" />small mass</label>

<br><p><input type="submit" name="submit1" value="Submit" /></p>
</form>
</body>
</html>
QUES4;

$_SESSION["q3"] = $_POST["three"];
//echo "This should show 0 or 1";
//echo $_SESSION["q3"];

if($_SESSION["q3"] == "1"){
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

