<?php
///Gets a few images and info for the see Cookies page
///Nate Roskelley September 2020

include 'connect.php';

$page = $_GET["pag"];
$sortMethod = ($_GET['sort']=='new')? 'age' : 'bought';



$query="";
//If the request is coming from search
if(isset($_GET["search"])){
	$srch = $_GET["search"];
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM images WHERE MATCH(description) AGAINST('$srch') AND NOT isPrivate = '1' LIMIT 25;";
}
//If the reason is a tag filter
else if(isset($_GET["filter"])){
	$filter = $_GET["filter"];
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM images WHERE tags REGEXP '$filter'  AND NOT isPrivate = '1' ORDER BY $sortMethod DESC LIMIT 25 OFFSET ".( 25 * $page );
}
//If the reason is to see a user's cookies
else if(isset($_GET["madeBy"])){
	$madeby = $_GET["madeBy"];
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM images WHERE pointerID = '$madeby';";
}
//Default reason
else{
	$query = "SELECT id, title, pointerID, description, bought, tags, age FROM images WHERE NOT isPrivate = '1' ORDER BY $sortMethod DESC LIMIT 25 OFFSET ".( 25 * $page );
}

$result = $conn->query($query);

//Get the data from the database
if($result->num_rows > 0) {
	$returnString="";
	while($row=mysqli_fetch_array($result)){
		for($a = 0;$a<=6;$a++){
			//Here, we package the data for the JS to unpack later
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
