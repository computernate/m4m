<?php
include 'connect.php';

$sql='SELECT * FROM tags';

$result = $conn->query($sql);


if($result->num_rows > 0) {
	$returnValue="";
	while($row=mysqli_fetch_array($result)){
		$returnValue.=$row[0].",";
	}
	echo $returnValue;
}
else {
	echo "false";
 }
 ?>