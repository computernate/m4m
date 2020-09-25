<?php
///Connects the user to the database
///Nate Roskelley September 2020

$servername = "merchies";
$username = "merchies";
//merchies
$password = "publicuse";
//publicuse
$dbname = "merchiescookies";
//merchiescookies

$conn=new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
