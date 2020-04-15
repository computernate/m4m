<?php

include 'connect.php';

$page = $_GET["pag"];
$sortMethod = ($_GET['sort']=='new')? 'age' : 'bought';

$query="";
if(isset($_GET["search"])){
	$srch = $_GET["search"];
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM memes WHERE MATCH(description) AGAINST('$srch') LIMIT 25;";
}
else if(isset($_GET["filter"])){
	$filter = $_GET["filter"];
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM memes WHERE tags REGEXP '$filter' ORDER BY $sortMethod DESC LIMIT 25 OFFSET ".( 25 * $page );
}
else if(isset($_GET["madeBy"])){
	$madeby = $_GET["madeBy"];
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM memes WHERE pointerID = '$madeby'";
}
else if(isset($_GET["likedBy"])||isset($_GET["madeBy"])){
	$likingUser = $_GET["likedBy"];
	$query = "SELECT memeid FROM likes WHERE userid='$likingUser'";

	$result = $conn->query($query);
	$returnString = "";
	if($result->num_rows > 0){
		while($row = mysqli_fetch_array($result)){
			$increment = 0;
			$memeid = $row["memeid"];
			$likedQuery = "SELECT id, title, pointerID, description, bought, tags, age FROM memes WHERE id = '$memeid'";
			$likedResult = $conn->query($likedQuery);
			if($likedResult->num_rows > 0) {
				while($likerow=mysqli_fetch_array($likedResult)){
					$increment++;
					for($a = 0;$a<=7;$a++){
						$returnString.=$likerow[$a];
						if($a!==7){
							$returnString.=":";
						}
						else{
							$returnString.=";";
						}
					}
				}
			}
			else echo " falseLike ";
		}
		echo $returnString;
	}
	else{
		echo "false";
	}
	exit();
}
else{
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM memes ORDER BY $sortMethod DESC LIMIT 25 OFFSET ".( 25 * $page );
}

$result = $conn->query($query);

if($result->num_rows > 0) {
	$returnString="";
	while($row=mysqli_fetch_array($result)){
		for($a = 0;$a<=6;$a++){
			$returnString.=$row[$a];
			if($a!==6){
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
