<?php

include 'connect.php';

$name=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["name"])));
$password=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["password"])));
$ID= mysqli_real_escape_string ($conn,strip_tags( trim($_POST["key"])));
$email=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["email"])));


if($name&&$password&&$ID&&$email&&$settings){

	$sql = "INSERT INTO users VALUES ( '$ID', '$name', '$password', '$email', 0, 0 )";
//id varchar(31) PRIMARY KEY, name varchar(255), password varchar (255), email varchar (255), popularMemes int (31), earnings double (15)
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	session_start();
    $_SESSION["user"]=$name;
	setcookie("username",$name,time()+(60*60*24*7));
	setcookie("password",$password,time()+(60*60*24*7));
	setcookie("ID",$ID,time()+(60*60*24*7));
	header("Location: ../me.php");
	//$conn->close();
}

else{
	header("Location: ../index.php");
}
?>