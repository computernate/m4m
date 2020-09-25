<?php
///Get a list of comments for the image based on the id
///Nate Roskelley September 2020

include 'connect.php';

//Get the ID of the cookie
$id = $_GET["id"];

//Select all of the comment data for that cookie
$query = "SELECT * FROM comments WHERE imageid='$id' ORDER BY colnum DESC;";

$result = $conn->query($query);

if($result->num_rows > 0) {
	$returnString="";
	//Here, we will package that data for unpacking with JS later
	//We separate comment data with a :, and each comment with a ;
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
	//Return that string
	echo $returnString;
}
else {
	echo "false";
 }

?>
