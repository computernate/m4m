<?php

include "connect.php";

session_start();

$username=mysqli_real_escape_string ($conn,$_POST["name"]);
$password=mysqli_real_escape_string ($conn,$_POST["password"]);

$sql='SELECT * FROM users WHERE name="'.$username.'" AND password="'.$password.'"';

$result = $conn->query($sql);


if($result->num_rows > 0) {
	$row=mysqli_fetch_array($result);
  $_SESSION["user"]=$row["name"];
	$_SESSION["ID"]=$row["id"];
	//echo print_r($row);
	$_SESSION["filetype"]=$row["filetype"];
	setcookie("username",$username,time()+(60*60*24*7));
	setcookie("password",$password,time()+(60*60*24*7));
	//setcookie("ID",$row["id"],time()+(60*60*24*7));

	echo "true";
}
else {
	$sql='SELECT * FROM users WHERE email="'.$username.'" AND password="'.$password.'"';

	$result = $conn->query($sql);


	if($result->num_rows > 0) {
		$row=mysqli_fetch_array($result);
		$_SESSION["user"]=$row["name"];
		$_SESSION["ID"]=$row["id"];
		setcookie("username",$username,time()+(60*60*24*7));
		setcookie("password",$password,time()+(60*60*24*7));
		header("Location:../index.php?message=Welcome!");
	}
	else {
		header("Location:../index.php?message=Error logging in. Please try again");
	 }
 }
?>
