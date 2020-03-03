<?php

include 'connect.php';
session_start();

$url=str_replace(" ", "_",mysqli_real_escape_string($conn,strip_tags( trim($_POST["memeTitle"]))));

$errorMessage="";
$checkql="SELECT id FROM memes WHERE id='$url'";
$result = $conn->query($checkql);
if($result->num_rows > 0) {
  $url = $url.rand();
}
$url = "../Memes/".$url.".png";
echo $url;

$img = $_POST['uploadingMeme'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

if(file_put_contents($url, $data)){
    echo 'moved';
  } else {
    $errorMessage= "Sorry, there was an error uploading your file.";
    echo 'not uploaded';
  }

$title=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["memeTitle"])));
$text=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["memeText"])));
$userID=$_SESSION["ID"];
$tags = $_POST['atags'];
$splitTags=explode(",",$tags);
for($i=0;$i<count($splitTags)-1;$i++){
	$tagsql="INSERT IGNORE INTO tags VALUES ('".$splitTags[$i]."');";
	$conn->query($tagsql);
}
echo 'other stuff done';
$date=date('Y-m-d H:i:s');
$isPrivate = (isset($_GET["isPrivate"]))?0:1;
$sql = "INSERT INTO memes VALUES ('$url', '$title', '$userID', 0, '$tags', '$text', '$isPrivate', $date )";
//id VARCHAR(31) PRIMARY KEY, title varchar(255), pointerID varchar (31), likes int(15),
//tags varchar (511), description varchar (511), isPrivate tinyint, age DATETIME(255))

if ($conn->query($sql) === TRUE && $uploadOk==1){
	echo 'true';
	header("Location:../index.php");
}
else{
	$errorMessage.= "<br>" . $conn->error.$uploadOk;
  echo 'false';
	header("Location:../newMeme.php?message=$errorMessage");
}
*/
?>
