<?php
$newhash='$2y$10$dFEaJeIt6gn2gonwj6e7CumdsV0SjPjk31.fYxEUNwioJm/Jy2XZe';//taken from db
$password="luway2012@@";//user keyed in password

if (password_verify($password, $newhash)) {
    echo"verified";
}
else
{
    echo"Not verified"; 
}

?>