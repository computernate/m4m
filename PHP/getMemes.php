<?php

include 'connect.php';

$page = $_GET["pag"];
$sortMethod = ($_GET['sort']=='new')? 'id' : 'score';
$filter = ($_GET["filter"]=="none")?"":"LIKE '".$_GET["filter"]."'";


$query = "SELECT id, hasShirt, title, fileType, pointerID, description, likes, tags FROM memes ORDER BY '$sortMethod' DESC $filter LIMIT 25 OFFSET ".( 25 * $page );

$result = $conn->query($query);

if($result->num_rows > 0) {
	$returnString="";
	while($row=mysqli_fetch_array($result)){
		for($a = 0;$a<=7;$a++){
			$returnString.=$row[$a];
			if($a!==7){
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