<?php
	session_start();
?>

<!--
Finished since last push
Make tags work
Minor design changes

LITTLE STUFF I NEED TO DO
Delete Meme
search by user
Email validation broken
like actions from post
Save tags in a cookie

UX and cart (April 1st)
Share to FB/Instagram 3/12
Better design overall -3/18
MOBILE FRIENDLY!!!!!!!! -3/27
Terms and conditions  -3/31
about us/report bugs -3/31

ADMIN THINGS (May 1st)
Cookies bought
Meme shipped
Report Content

-->

<html ng-app="money4memes">
	<head>
		<title>The Memery</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		<div id="wrapper">

		<?php
			if(!isset($_SESSION["user"])){
		 ?>

		 <div id="intro">
			 <h1>Welcome to the Memery!</h1>
			 <p><span>Buy cookies</span> with memes on them, and get it shipped to you right away! They make <span>perfect gifts</span>, or a great way to take a party to the next level!</p>
			 <p>Or, create a meme and <span>get paid</span> when people buy your cookie! <span>Click the M</span> to sign up!</p>
		 </div>

	 <?php } ?>
		<?php
			if(isset($_GET["sort"])&&$_GET['sort']=='new'){
				echo '<span ng-init = "sortMethod=\'new\';"></span>';
			}
			else{
				echo '<span ng-init = "sortMethod=\'good\';"></span>';
			}
		?>
			<div class="tagControls">
				<p id="filters" ng-init = "getTags()">
					<span ng-repeat = "tag in tags" [id]='{{tag}}' ng-class='{inactiveTag : activeTagFilters.indexOf(tag)!==-1}' ng-click='toggleTag(tag)' class = 'tag'>
						{{tag}}
					</span>
				</p>

				<input type="button" ng-click="refreshPage()" value="See memes with highlighted tags"/>
			</div>
			<div id="allMemes">
				<div ng-init="getMoreMemes('');pagination=0;"></div>
			</div>

		</div>
	</body>
</html>
