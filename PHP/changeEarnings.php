  <?php

include 'connect.php';
session_start();


$newBanking=$_POST['earningsMethod']."-".mysqli_real_escape_string ($conn,strip_tags( trim($_POST["earningsID"])));

$userID=$_SESSION["ID"];

$sql = "UPDATE users SET bankingID='$newBanking' WHERE id='$userID';";

if ($conn->query($sql) === TRUE){
	header("Location: ../index.php");
}
else{
	echo $conn->error;
}

?>
