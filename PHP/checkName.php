<?php

include 'connect.php';

$sql="SELECT * FROM users WHERE name = '".mysqli_real_escape_string ($conn,strip_tags( trim($_GET["sql"])))."';";
$result='';
$result = $conn->query($sql);


if($result->num_rows > 0) {
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$returnValue=array();
		$returnValue[$counter]=array();
		foreach($row as $key => $value ){
			$returnValue[$counter][$key]=$value;
		}
		$counter++;
	}
	echo json_encode($returnValue);
}
else {
	echo "false";
 }

?>