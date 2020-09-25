<?php
///Connects the user to the database
///Nate Roskelley September 2020

$servername = "localhost";
$username = "root";
//merchies
$password = "";
//publicuse
$dbname = "merchies";
//merchiescookies

$conn=new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
