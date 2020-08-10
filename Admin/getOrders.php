<?php

include "../PHP/connect.php";
include "checkIsAdmin.php";

if(!$isAdmin){
  die("You do not have access for this");
}

$query = "SELECT * FROM orders ORDER BY size;";
$result = $conn->query($query);

if($result->num_rows > 0) {
	$returnString="";
	while($row=mysqli_fetch_array($result)){
		for($a = 0;$a<=3;$a++){
			$returnString.=$row[$a];
			if($a!==3){
				$returnString.=":";
			}
			else{
				$returnString.=";";
			}
		}
	}
	echo $returnString;
}
else {
	echo "false";
 }
?>
