<?php
///Deletes the cookie info
///Nate Roskelley September 2020


include 'connect.php';
session_start();

//Get the current user and cookie
$user=$_SESSION["ID"];
$cookie = $_GET["cookieid"];

//Make sure the user is the one trying to delete
$checkUserSql = "SELECT pointerID FROM images WHERE id = '$cookie';";
$checkUserName;
$checkingUserNameQuery=$conn->query($checkUserSql);
if($checkingUserNameQuery->num_rows > 0) {
	while($row=mysqli_fetch_array($checkingUserNameQuery)){
		$checkUserName=$row[0];
	}
}


//If they are, delete the image
if($checkUserName == $user){
  $deleteSQL = "DELETE FROM images WHERE id = '$cookie';";

  $deleted = $conn->query($deleteSQL);

  if(!$deleted){
    echo "AN ERROR HAS OCCURRED. PLEASE TRY AGAIN";
  }
  else{
    header("Location: index.php?message=Sucessfully deleted");
  }
}

?>
