<?php
///Gets the list of tags that exist
///Nate Roskelley September 2020
include 'connect.php';

$sql='SELECT * FROM tags';

$result = $conn->query($sql);

//Select all the tags
if($result->num_rows > 0) {
	$returnValue="";
	//Package them by separating them by a comma
	while($row=mysqli_fetch_array($result)){
		$returnValue.=$row[0].",";
	}
	echo $returnValue;
}
else {
	echo "false";
 }
 ?>
