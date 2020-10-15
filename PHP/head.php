<?php
///Head data
///Nate Roskelley September 2020

include 'connect.php';

$loggedIn=false;

//If we have cookies, we will log the user in.
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

//If there is a message passed from another page, we will put that at the head
if(isset($_GET["message"])){
	echo '<div id="topMessage"><h2>'.$_GET["message"].'</h2></div>';
}

$rand = rand(0,1);

if($rand==1){
	$_SESSION['HugePrice']='$2.99';
	$_SESSION['MediumPrice']='$2.49';
	$_SESSION['SmallPrice']='$2.99';

	$_SESSION['HugePin']="33536730759300";
	$_SESSION['MediumPin']="33536730792068";
	$_SESSION['SmallPin']="33536730824836";
}
else{
	$_SESSION['HugePrice']='$2.49';
	$_SESSION['MediumPrice']='$1.99';
	$_SESSION['SmallPrice']='$2.49';

	$_SESSION['HugePin']="36559852011684";
	$_SESSION['MediumPin']="36559852044452";
	$_SESSION['SmallPin']="36559852077220";
}



?>
<div style='visibility:hidden' ng-init='HugePin="<?php echo $_SESSION['HugePin'] ?>";'></div>
<div style='visibility:hidden' ng-init='MediumPin="<?php echo $_SESSION['HugePin'] ?>";'></div>
<div style='visibility:hidden' ng-init='SmallPin="<?php echo $_SESSION['HugePin'] ?>";'></div>
<div style='visibility:hidden' ng-init='HugePrice="<?php echo $_SESSION['HugePrice'] ?>";'></div>
<div style='visibility:hidden' ng-init='MediumPrice="<?php echo $_SESSION['MediumPrice'] ?>";'></div>
<div style='visibility:hidden' ng-init='SmallPrice="<?php echo $_SESSION['SmallPrice'] ?>";'></div>

<link type="text/css" rel="stylesheet" href="CSS/main.css" />
<link type="text/css" rel="stylesheet" href="CSS/color1.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<script src="JS/angular.js"> </script>
<script src="JS/jquery-3.4.1.js"> </script>
<script src="JS/merchiesapp.js"> </script>

<div id="header" ng-class="{'scrolledUp':scrolledUp}">
	<div id="fullNav" ng-class="{activeFullNav:activatedFullNav}">
	<div id="navToggleUpper">
		<img src="Images/navToggle.png" alt="Navigation" ng-click="activatedFullNav=!activatedFullNav">
	</div>
		<?php
			//If the user is logged in, we show him his view. Otherwise, show login and signup info.
			if(!$loggedIn){
				include "loginView.php";
			}
			else{
				include "userSidebar.php";
			}
		?>
	</div>

	<!-- The button to click to show the user sidebar -->
	<div id="navToggle">
		<img src="Images/navToggle.png" alt="Navigation" ng-click="activatedFullNav=!activatedFullNav">
	</div>


	<div class="topnav" id="top" >

		<a href="index.php" style='<?php
			if(!isset($_GET["sort"])&&strpos($_SERVER['REQUEST_URI'],"index.php")!=false){
				echo "background-color:var(--head-nav-bg-color-2);";
			} ?>'>Create Cookie</a>

		<a href="seeCookies.php?sort=new" style='<?php
			if(isset($_GET["sort"])&&strpos($_SERVER['REQUEST_URI'],"seeCookies.php")!=false){
				echo "background-color:var(--head-nav-bg-color-2);";
			} ?>'>About Merchies</a>

			<a href="https://merchies-shop.com/cart" class="cookieJar">Cart</a>


		<!--The search bar-->
		<form name="search" method="get" action="search.php">
			<div class="searchBox">
					<input class="searchInput" type="text" name="search" placeholder="Search">
					<button class="searchButton" href="#">
							<i class="material-icons">
									search
							</i>
					</button>
			</div>
		</form>

	</div>
</div>

<div id='SocialMediaLinks'>
	<a href="https://www.facebook.com/merchiescookies"><img src='../Images/fb.png' /></a>
	<a href="https://www.instagram.com/merchiescookies/"><img src='../Images/insta.png' /></a>
</div>
