<?php

include 'connect.php';
session_start();

if(!isset($_SESSION["ID"])){
	die("Please log in to comment");
}

$id=mysqli_real_escape_string ($conn,strip_tags( trim($_GET["id"])));

$content=mysqli_real_escape_string ($conn,strip_tags( trim($_GET["content"])));
if($content==""||$content==" "){
	die("No Content");
}
//die($content);

$userID=$_SESSION["ID"];
$userName=$_SESSION["user"];

$sql = "INSERT INTO comments VALUES ('$content', '$userID', '$id', '$userName');";

if ($conn->query($sql) === TRUE){
	echo 'true';
}
else{
	echo $conn->error;
}

?>
