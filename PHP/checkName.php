<?php
///This page is to return if a username is already taken. See merchiesapp.js for more info
///Nate Roskelley September 2020


include 'connect.php';

//Select the name
$sql="SELECT name FROM users WHERE name = '".mysqli_real_escape_string ($conn,strip_tags( trim($_GET["sql"])))."';";
$result='';
$result = $conn->query($sql);

//If it exists, return true
if($result->num_rows > 0) {
	echo "true";
}
else {
	echo "false";
 }

?>
