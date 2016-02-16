<?php
session_start();

$user = $_POST["username"];
$pass = $_POST["password"];

$_SESSION["user"] = $user;
$_SESSION["correct"] = 0;
$_SESSION["q1"] = "";
$_SESSION["q2"] = "";
$_SESSION["q3"] = "";
$_SESSION["q4"] = "";
$_SESSION["q5"] = "";
$_SESSION["q6"] = "";
          
setcookie($user,"loggedon",time()+900,"/","cs.utexas.edu",0);
        

echo <<<HEAD
<!DOCTYPE html>
<html>
<head><title>Login</title> 
</head>
<body>
<p> 
HEAD;
    
    
$flagin = false;

echo "<input type='hidden' name='user'/>";


$file = fopen("passwd.txt","r");

while(!feof($file))
{
$line = fgets($file);
$arr1 = explode (":",$line);
$usercheck = $arr1[0];
$passcheck = $arr1[1];
$usercheck = trim($usercheck);
$passcheck = trim($passcheck);
if (($user == $usercheck) && ($pass == $passcheck) && ($user!=""))
{
$flagin = true;
}

}
fclose($file);

$hastaken = false;
$resfile = fopen("results.txt","r");

while(!feof($resfile))
{
$rline = fgets($resfile);
$rline = trim($rline);

$lastor = strpos($rline,":");
$usernamepluscolon = $lastor + 1;
$userres = substr($rline,0,$lastor);

if ($user == $userres)
{
        if ($usernamepluscolon < strlen($rline))
        {
        $hastaken=true;
        break;
        }
}

}


fclose($resfile);

if ($flagin){
echo "Congrats! Login Successful.";
echo "<input type='hidden' name='loginuser' value=$user>";
//setcookie($user,$pass,time()+120,"/","cs.utexas.edu",0);
echo "<br/>";
//check if user has already taken quiz or not
if ($hastaken == true){
echo "Unfortunately, you have taken this quiz already and cannot take it again.";
echo "<br/><form method='post' action='hwk12.html'><input type='submit' value='Return to Login'/></form>";


session_unset();
session_destroy();
}
else{
echo "<br/>Click <i>Take Quiz</i> to begin.<br/>You may only take it once.<br/>You have 15 minutes to complete the quiz.";
echo "<form method='post' action='q1.php'><input type='submit' name='submit' value='Take Quiz'/></form>";


}


}
else{
echo "Login unsuccessful.";
echo "<br/><form method='post' action='hwk12.html'><input type='submit' value='Return to Login'/></form>";

session_unset();
session_destroy();

}

?>
</body>
</html>

