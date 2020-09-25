<?php
///Submits a comment on an image
///Nate Roskelley September 2020

include 'connect.php';
session_start();

//If the user isn't logged in, tell them to
if(!isset($_SESSION["ID"])){
	die("Please log in to comment");
}

$id=mysqli_real_escape_string ($conn,strip_tags( trim($_GET["id"])));

//Verify that the user has provided content
$content=mysqli_real_escape_string ($conn,strip_tags( trim($_GET["content"])));
if($content==""||$content==" "){
	die("No Content");
}
//die($content);

$userID=$_SESSION["ID"];
$userName=$_SESSION["user"];
//Insert the comment into the comment base
$sql = "INSERT INTO comments VALUES ('$content', '$userID', '$id', '$userName');";

if ($conn->query($sql) === TRUE){
	echo 'true';
}
else{
	echo $conn->error;
}

?>
