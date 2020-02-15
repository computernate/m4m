<?php
include 'connect.php';
session_start();

$meme1=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["meme1"])));
$meme2=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["copyMeme"])));
$userID=$_SESSION["ID"];

$sql = "INSERT into copyReports VALUES ('$meme1','$meme2','$userID');";

if ($conn->query($sql) === TRUE ){
  header("Location:../index.php?message=Thank you for reporting the repost!");
  echo 'right';
}
else{
	echo $conn->error;
    header("Location../reportCopy.php?message=Something went wrong. Please try again.&copyid=".$meme1);
}
?>
