<?php

setcookie("username", "", time() - 3600);
header('Location: http://zweb.cs.utexas.edu/users/cs329e-fa15/pjobrien/hw13/login.html');

?>
