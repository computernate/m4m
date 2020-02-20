<?php

include 'connect.php';
session_start();

$url=date("y-m-d")."-".date("h-i-s").rand();

$target_dir = "../Memes/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir . $url . '.' . $imageFileType;
$errorMessage="";

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
        echo 'Image size okay';
    } else {
        $errorMessage= "File is not an image.";
        $uploadOk = 0;
      	//header("Location:../newMeme.php?message=$errorMessage");
        echo 'File is not an image';
    }

	if ($_FILES["fileToUpload"]["size"] > 1500000) {
    $errorMessage= "Sorry, your file is too Dank. Please try a smaller sized meme.";
    $uploadOk = 0;
    echo 'file too large';
  	//header("Location:../newMeme.php?message=$errorMessage");
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $errorMessage= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    echo 'file type okay';
  //	header("Location:../newMeme.php?message=$errorMessage");
}


if ($uploadOk == 0) {
    $errorMessage= "Sorry, your file was not uploaded.";
    echo 'not uploaded';
  	//header("Location:../newMeme.php?message=$errorMessage");
	}
	else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo 'moved';
		} else {
			$errorMessage= "Sorry, there was an error uploading your file.";
      echo 'not uploaded';
		}
	}
}

$title=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["title"])));
$text=mysqli_real_escape_string ($conn,strip_tags( trim($_POST["text"])));
$userID=$_SESSION["ID"];
$tags = $_POST['atags'];
$splitTags=explode(",",$tags);
for($i=0;$i<count($splitTags)-1;$i++){
	$tagsql="INSERT IGNORE INTO tags VALUES ('".$splitTags[$i]."');";
	$conn->query($tagsql);
}
echo 'other stuff done';
//id, title, pointer, likes, age, score, hasshirt, tags, description, fileType
$sql = "INSERT INTO memes VALUES ('$url', '$title', '$userID', 0, 0, 0,0,'$tags', '$text', '$imageFileType', 0 )";
//( id VARCHAR(31) PRIMARY KEY, title varchar(511), pointerID varchar (31), likes int(15), age int(255), score int (127),
	//hasShirt tinyint, tags varchar (511), description varchar (255), fileType varchar (8), isPrivate tinyint);

if ($conn->query($sql) === TRUE && $uploadOk==1){
	echo 'true';
	header("Location:../index.php");
}
else{
	$errorMessage.= "<br>" . $conn->error.$uploadOk;
  echo 'false';
	header("Location:../newMeme.php?message=$errorMessage");
}

?>
