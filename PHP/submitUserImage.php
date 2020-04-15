<?php

include 'connect.php';
session_start();

$id=$_SESSION["ID"];

$target_dir = "../userImages/";
$target_file = $target_dir . basename($_FILES["userImageFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir . $id . '.' . $imageFileType;
$errorMessage="";

//if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["userImageFile"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
        echo 'Image size okay';
    } else {
        $errorMessage= "File is not an image.";
        $uploadOk = 0;
      	//header("Location:../newMeme.php?message=$errorMessage");
        echo 'File is not an image';
    }

	if ($_FILES["userImageFile"]["size"] > 1500000) {
    $errorMessage= "Sorry, your profile is too Dank. Please try a smaller sized meme.";
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
		if (move_uploaded_file($_FILES["userImageFile"]["tmp_name"], $target_file)) {
      echo 'moved';
		} else {
			$errorMessage= "Sorry, there was an error uploading your file.";
      echo 'not uploaded';
		}
	}
//}


$sql = "UPDATE users SET fileType='$imageFileType' WHERE id = '$id';";


if ($conn->query($sql) === TRUE && $uploadOk==1){
	echo 'true';
  $_SESSION['filetype']=$imageFileType;
  header("Location:../index.php?message=Profile Picture Successfully changed");
}
else{
	$errorMessage.= "<br>" . $conn->error.$uploadOk;
  echo 'false';
  echo $errorMessage;
	header("Location:../index.php?message=$errorMessage");
}
