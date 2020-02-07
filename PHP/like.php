<?php

include 'connect.php';
session_start();

$id = $_GET["id"];
$user=$_SESSION["ID"];

$query2="SELECT likes FROM memes WHERE id='$id';";
$likes=$conn->query($query2);
$numLikes=0;
if($likes->num_rows > 0) {
	while($row=mysqli_fetch_array($likes)){
		$numLikes=intval($row[0]);
	}
}
else{
	echo "Error. Please try again.";
}
$query = "SELECT * FROM likes WHERE memeid='$id' AND userid='$user';";

$result = $conn->query($query);

$likeQuery="";

$qurey3;
if($result->num_rows > 0) {
	$numLikes=$numLikes-1;
	$likeQuery = "DELETE FROM likes WHERE memeid='$id' AND userid='$user';";
	$query3="UPDATE memes SET likes = likes - 1 AND score = score - 1 WHERE id='$id';";
}
else{
	$numLikes=$numLikes+1;
	$likeQuery="INSERT INTO likes VALUES ('$user','$id');";
	$query3="UPDATE memes SET likes = likes + 1 AND score = score + 1 WHERE id='$id';";
}

$likeResult = $conn->query($likeQuery);

$updateResult=$conn->query($query3);

echo $numLikes;