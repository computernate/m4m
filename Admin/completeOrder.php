<?php

include "../PHP/connect.php";
include "checkIsAdmin.php";

if(!$isAdmin){
  die("You do not have access for this");
}

$id=$_GET["cookie"];
$isPrivate=$_GET["isPrivate"];
$size=$_GET["size"];
$orderid=$_GET["orderid"];

if($isPrivate==0){

    $getUserSql = "SELECT pointerID FROM images WHERE id='$id'";
    $resultUser = $conn->query($getUserSql);

    if($resultUser->num_rows > 0) {

    	while($row=mysqli_fetch_array($resultUser)){

        $changeMoneySql;
        if($size == 2){
          $changeMoneySql="UPDATE users SET earnings = earnings + .75 WHERE id = '".$row["pointerID"]."';";
        }
        else{
          $changeMoneySql="UPDATE users SET earnings = earnings + 1 WHERE id = '".$row["pointerID"]."';";
        }
        $conn->query($changeMoneySql);

        $increaseCookies = "UPDATE images SET bought = bought + 1 WHERE id='$id';";
        $conn->query($increaseCookies);
      }
    }
    else{
      echo "User not found. Unable to give money n stuff";
    }
}


  $deleteSql = "DELETE FROM orders WHERE orderid=$orderid;";
  $likes=$conn->query($deleteSql);


    echo "true";


 ?>
