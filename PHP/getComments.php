<?php

include 'connect.php';

$id = $_GET["id"];


$query = "SELECT * FROM comments WHERE memeid='$id' ORDER BY colnum DESC;";

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