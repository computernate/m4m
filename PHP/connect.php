<?php

$servername = "localhost";
$username = "root";
//merchies
$password = "";
//publicuse
$dbname = "money_4_memes";
//merchiescookies

$conn=new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
