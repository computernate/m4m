<?php
///Submit a cookie. If info is supplied to add to the saving database,
///make sure $_POST["comingFromHome"] is set to 1
///Nate Roskelley September 2020

include 'connect.php';
session_start();

//Get the new url
$url=str_replace(" ", "_",mysqli_real_escape_string($conn,strip_tags( trim($_POST["imageTitle"]))));


$errorMessage="";

//Make sure that the url doesn't already exist, add a random number to the end if it does
$checkql="SELECT id FROM images WHERE id='$url'";
$result = $conn->query($checkql);
if($result->num_rows > 0) {
  $url = $url.rand();
}
//Get the url after the change
$newurl = "../userCookies/".$url.".png";
echo $newurl;


$img = $_POST['uploadingImage'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);

//Upload file
if(file_put_contents($newurl, $data)){
    echo 'moved';
} else {
    $errorMessage= "Sorry, there was an error uploading your file.";
    echo 'not uploaded';
}

//If the user is temporary, we are done
if(isset($_POST["comingFromHome"]))
  die("finished, go back home");

//Get the user provided info
$title=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["imageTitle"])));
$text=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["imageText"])));
$userID = "";
//Get the user
if(isset($_SESSION["ID"]))
  $userID=$_SESSION["ID"];
//Get the tags
$tags = $_POST['atags'];
$splitTags=explode(",",$tags);
for($i=0;$i<count($splitTags)-1;$i++){
	$tagsql="INSERT IGNORE INTO tags VALUES ('".$splitTags[$i]."');";
	$conn->query($tagsql);
}

//Get already established info
$date=date('Y-m-d H:i:s');
$private = (isset($_POST['isPrivate']))?1:0;
$sql = "INSERT INTO images VALUES ('$url', '$title', '$userID', 0, '$tags', '$text', '$date', $private )";

//Create the image in the database
if ($conn->query($sql) === TRUE){
	echo 'true';
	   header("Location: ../cookie.php?cookie=".$url);
}
else{
	$errorMessage.= "<br>" . $conn->error.$uploadOk;
  echo 'false';
  echo $errorMessage;
	   header("Location: ../newCookie.php?message=$errorMessage");
}

?>
