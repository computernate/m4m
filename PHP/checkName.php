<?php

include 'connect.php';

$sql="SELECT name FROM users WHERE name = '".mysqli_real_escape_string ($conn,strip_tags( trim($_GET["sql"])))."';";
$result='';
$result = $conn->query($sql);


if($result->num_rows > 0) {
	echo "true";
}
else {
	echo "false";
 }

?>
