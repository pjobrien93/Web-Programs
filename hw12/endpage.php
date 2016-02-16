

<?php
session_start();
$user = $_SESSION["user"];
echo <<<ENDPG
<html>
<head><title>Question 6</title>
<script type = "text/javascript" >
    history.pushState(null, null, 'endpage.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'endpage.php');
    });
    </script>
</head>
<body>
<h2>Results</h2>
ENDPG;

$_SESSION["q6"] = $_POST["six"];
//echo "This should show what you inputted ";
//echo $_SESSION["q6"];

if($_SESSION["q6"] == "age"){
$_SESSION["correct"] = $_SESSION["correct"] + 1;
}
$correct = $_SESSION["correct"];
$score = $correct*10;
if ($score == 0){
$score = "00";
}
echo "You got $score out of 60.";
echo "<br/><br/><form method='post' action='hw12.html'><input type='submit' value='Return to Login'/></form>";
echo "</body>";
echo "</html>";
//write to results file
$buildnew = array();
$changeit = fopen("results.txt","r");
while(!feof($changeit))
{
$line = fgets($changeit);
$line = trim($line);
$indexofcolon = strpos($line,":");
$before = substr($line,0,$indexofcolon);
if (strlen($line) == ($indexofcolon + 1)){
$after = "";
}
else{
$after = substr($line,$indexofcolon+1,$indexofclon+3);
}
$before = trim($before);


if ($before == $user)
{
$after = $score;
$after = (string)$after;
//$after = $after . " out of 60.";
}
$te = $before . ":" . $after;

array_push($buildnew, $te);
}
fclose($changeit);

array_pop($buildnew);
fclose("changeit");



$chan = fopen("results.txt","w");
for ($x = 0; $x<count($buildnew); $x++)
{
$adit = $buildnew[$x] . "\n";
fwrite($chan,$adit);
}


fclose($chan);



session_unset();
session_destroy();

?>


