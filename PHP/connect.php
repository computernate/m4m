<?php
$servername = "localhost";
$username = "merchies";
$password = "publicuse";
$dbname = "merchiescookies";

$conn=new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
