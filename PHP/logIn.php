<?php
///Take the name and password, log the user in.
///Nate Roskelley September 2020

include "connect.php";

session_start();

//Get the provided username and password
$username=mysqli_real_escape_string ($conn,$_POST["name"]);
$password=mysqli_real_escape_string ($conn,$_POST["password"]);

$sql='SELECT * FROM users WHERE name="'.$username.'" AND password="'.$password.'"';

$result = $conn->query($sql);

//Handle if the user suppplied a username
if($result->num_rows > 0) {
	$row=mysqli_fetch_array($result);
  $_SESSION["user"]=$row["name"];
	$_SESSION["ID"]=$row["id"];

	//Set the user image filetype
	$_SESSION["fileType"]=$row["fileType"];

	//Set the cookies
	setcookie("username",$username,time()+(60*60*24*7));
	setcookie("password",$password,time()+(60*60*24*7));

	//Take me home
	header("Location: ../index.php?message=Welcome!");
}
//Handle if the user suppplied an email
else {
	$sql='SELECT * FROM users WHERE email="'.$username.'" AND password="'.$password.'"';

	$result = $conn->query($sql);


	if($result->num_rows > 0) {
		$row=mysqli_fetch_array($result);
	  $_SESSION["user"]=$row["name"];
		$_SESSION["ID"]=$row["id"];

		//Set the user image filetype
		$_SESSION["fileType"]=$row["fileType"];

		//Set the cookies
		setcookie("username",$username,time()+(60*60*24*7));
		setcookie("password",$password,time()+(60*60*24*7));

		//Take me home
		header("Location: ../index.php?message=Welcome!");
	}
	else {
		header("Location: ../index.php?message=Invalid username or password");
	 }
 }
?>
