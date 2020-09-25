<?php
///Logs the user out
///Nate Roskelley September 2020
session_start();
	unset($_SESSION["user"]);
	unset($_COOKIE["username"]);
	unset($_COOKIE["password"]);
	session_destroy();
	echo 'true';
?>
