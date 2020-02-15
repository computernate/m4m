<?php
include 'connect.php';
session_start();

$meme1=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["meme1"])));
$meme2=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["copyMeme"])));

$sql1 = "SELECT * FROM likes WHERE memeid='$meme1'";

$meme1likes=[];

$result = $conn->query($sql1);
$returnString = "";
if($result->num_rows > 0){
	while($row = mysqli_fetch_array($result)){
    array_push($meme1likes, $row);
  }
}

$sql2 = "SELECT * FROM likes WHERE memeid='$meme1'";

$meme2likes=[];

$result = $conn->query($sql2);
$returnString = "";
if($result->num_rows > 0){
	while($row = mysqli_fetch_array($result)){
    array_push($meme2likes, $row);
  }
}

$counter=count($meme1likes);

for($a =0;$a<count($meme1likes);$a++){
  if(in_array($meme1likes[$a],$meme2likes)){
    unset($meme1likes,$a);
    $counter--;
  }
}

$string='';


for($b : $meme1likes){
  $string.="INSERT INTO likes VALUES('$b','$meme2');";
}


$result = $conn->query($string);

$removesql = "DELETE FROM memes WHERE memid='$meme1'";
$result = $conn->query($removesql);

$updateLikessql = "UPDATE memes SET likes = $counter AND score = score + $counter WHERE $id = '$meme2';";
$result = $conn->query($updateLikessql);

?>
