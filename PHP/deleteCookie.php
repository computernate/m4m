<?php
include 'connect.php';
session_start();

$user=$_SESSION["ID"];
$cookie = $_GET["id"];

$checkUserSql = "SELECT pointerID FROM memes WHERE id = '$cookie';";

$checkUserName;

$likes=$conn->query($checkUserSql);
$numLikes=0;
if($likes->num_rows > 0) {
	while($row=mysqli_fetch_array($likes)){
		$checkUserName=intval($row[0]);
	}
}
else{
  echo var_dump($likes);
}

if($checkUserName == $user){
  $deleteSQL = "DELETE FROM memes WHERE id = '$cookie';";

  $deleted = $conn->query($deleteSQL);

  if(!$deleted){
    echo "AN ERROR HAS OCCURRED. PLEASE TRY AGAIN";
  }
  else{
    header("Location: index.php?message=Sucessfully deleted");
  }
}

?>
