<?php

include 'connect.php';

$name=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["name"])));
$password=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["pass"])));
$email=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["email"])));
$promo=(isset($_POST["getPromo"]))?"true":"false";

$id = $name;

if($name&&$password&&$email&&$promo){

	$sql = "INSERT INTO users VALUES ('$id', '$name', '$password',  '$email','0','0','0','0','')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	session_start();
  $_SESSION["user"]=$name;
	$_SESSION["ID"]=$id;
	setcookie("username",$name,time()+(60*60*24*7));
	setcookie("password",$password,time()+(60*60*24*7));
	header("Location: ../index.php?message=You have been successfully created! Enjoy Meming");
	//$conn->close();
}

else{
	echo "ERROR:";
	//header("Location: ../index.php?message=You have been successfully created! Enjoy Meming");
}
?>
