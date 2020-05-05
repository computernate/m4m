<?php

include 'connect.php';
session_start();

$sql="SELECT admin FROM users WHERE id = '".$_SESSION["ID"]."';";
$result='';
$result = $conn->query($sql);
$isAdmin = false;


if($result->num_rows > 0) {
	while($row=mysqli_fetch_array($result)){
		if($row["admin"]=="1"){
			$isAdmin = true;
		}
	}
}
else {
	echo "false";
 }

?>
