<?php
///Allows a user to submit an image for a profile picture
///Nate Roskelley September 2020

include 'connect.php';
session_start();

$id=$_SESSION["ID"];

$target_dir = "../userImages/";
$target_file = $target_dir . basename($_FILES["userImageFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir . $id . '.' . $imageFileType;
$errorMessage="";

//Uploadfile and check to make sure it is okay
$check = getimagesize($_FILES["userImageFile"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
    echo 'Image size okay';
} else {
    $errorMessage.= "File is not an image.";
    $uploadOk = 0;
    echo 'File is not an image';
}
if ($_FILES["userImageFile"]["size"] > 1500000) {
  $errorMessage.= "Sorry, your profile is too large.";
  $uploadOk = 0;
  echo 'file too large';
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $errorMessage.= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    echo 'file type okay';
}


if ($uploadOk == 0) {
  $errorMessage.= " Your file was not uploaded.";
  echo 'not uploaded';
}
else {
	if (move_uploaded_file($_FILES["userImageFile"]["tmp_name"], $target_file)) {
    echo 'moved';
	} else {
		$errorMessage= "Sorry, there was an error uploading your file.";
    echo 'not uploaded';
	}
}

//Update the user's info to point to the new image
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
