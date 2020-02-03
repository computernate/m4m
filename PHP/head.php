<?php

include 'connect.php';

$loggedIn=false;

if(isset($_COOKIE["username"])&&!isset($_SESSION["user"])){
	echo "{{logIn(".$_COOKIE["username"].",".$_COOKIE["password"].")}}";
}
if(isset($_SESSION["user"])){
	echo "<span ng-init='userName=\"".$_SESSION["user"]."\"'></span>";
	echo "<span ng-init='userID=\"".$_SESSION["ID"]."\"'></span>";
	echo "<span ng-init='loggedIn=true'></span>";
	$loggedIn=true;
}
else{
	echo "<span ng-init='loggedIn=false'></span>";
}

?>


<link type="text/css" rel="stylesheet" href="CSS/main.css" />
<link type="text/css" rel="stylesheet" href="CSS/color1.css" />
<script src="js/angular.js"> </script>
<script src="js/memeapp.js"> </script>

<div id="header" ng-class="{'scrolledUp':scrolledUp}">
	<div id="fullNav" ng-class="{activeFullNav:activatedFullNav}">
	<div id="navToggleUpper">
	<img src="Images/navToggle.jpg" alt="Navigation" ng-click="activatedFullNav=!activatedFullNav">
</div>
		<?php
			if(!$loggedIn){
				include "loginView.php";
			}
			else{
				include "userSidebar.php";
			}
		?>
	</div>
	<div id="navToggle">
		<img src="Images/navToggle.jpg" alt="Navigation" ng-click="activatedFullNav=!activatedFullNav">
	</div>
	<div class="topnav" id="top" >
		<a href="index.php">Good Memes</a>
		<a href="index.php?sort=new">New Memes</a>
	</div>
</div>