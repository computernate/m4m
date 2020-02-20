<?php

include 'connect.php';

$reason = $_GET["reason"];
$id = $_GET["id"];
$query='';

if($reason=="memeUser"){
	$query = 'SELECT name FROM users WHERE id="'.$id.'"';
}
$result = $conn->query($query);

if($result->num_rows > 0) {
	$returnString="";
	while($row=mysqli_fetch_array($result)){
		$returnString.='<p>By: <a href="userPage.php?uid='.$id.'">'.$row['name'].'</a></p>';
	}
	echo $returnString;
}
else{
	echo $id;
	echo $query;
	echo "Creator not found";
}
?>
