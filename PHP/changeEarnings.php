<?php
///Changes the earnings info for a user. Validation is done in merchiesapp.js
///Nate Roskelley September 2020


include 'connect.php';
session_start();

//Get the new banking method
$newBanking=$_POST['earningsMethod']."-".mysqli_real_escape_string ($conn,strip_tags( trim($_POST["earningsID"])));
//Get the user ID
$userID=$_SESSION["ID"];


//Update the banking method
$sql = "UPDATE users SET bankingID='$newBanking' WHERE id='$userID';";
if ($conn->query($sql) === TRUE){
	header("Location: ../newCookie.php?message=Earnings info saved. Create your cookie!");
}
else{
	echo $conn->error;
}

?>
