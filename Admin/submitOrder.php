<?php

include "../PHP/connect.php";
include "checkIsAdmin.php";

if(!$isAdmin){
  die("You do not have access for this");
}

$picid = $_GET["picid"];
$size = $_GET["size"];
$isPersonal = $_GET["private"];
$orderId = rand();

$sql = "INSERT INTO orders VALUES('$picid', $size, $isPersonal, $orderId);";

if ($conn->query($sql) === TRUE){
  echo "true";
}
else{
  echo "false";
}
?>
