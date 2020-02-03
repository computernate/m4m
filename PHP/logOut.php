<?php
session_start();
	unset($_SESSION["user"]);
	unset($_COOKIE["username"]);
	unset($_COOKIE["password"]);
	session_destroy();
	echo 'true';
?>