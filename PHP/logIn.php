<?php

include "connect.php";

session_start();

$username=mysqli_real_escape_string ($conn,$_GET["name"]);
$password=mysqli_real_escape_string ($conn,$_GET["password"]);

$sql='SELECT * FROM users WHERE name="'.$username.'" AND password="'.$password.'"';

$result = $conn->query($sql);


if($result->num_rows > 0) {
	$row=mysqli_fetch_array($result);
    $_SESSION["user"]=$row["name"];
	$_SESSION["ID"]=$row["id"];
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
		//setcookie("ID",$row["id"],time()+(60*60*24*7));

		echo "true";
	} 
	else {
		echo "false";
	 }
 }
?>