<?php
	session_start();
?>


<!--
Finished since last push
Report copy/copywright - 15
Liked pages
User page - 19
-user image

TO DO NEXT

BIG STUFF I NEED TO DO BEFORE FEB 29th
Meme editor -29

LITTLE STUFF I NEED TO DO
Show tags
Save tags in a cookie
like actions from post
Better meme names
nav tell where page is
Another table that sorts by score
search by user
Email validation broken

STUFF I NEED TO DO BEFORE BETA RELEASE (May 1st)
Terms and conditions
about us/report bugs
Better design overall
MOBILE FRIENDLY!!!!!!!!
Cart
Sign in with google/fb
Share to FB/Instagram
Link bank account / paypal?
Top dozen (By tag as well)


-->


<html ng-app="money4memes">
	<head>
		<title>The Memery</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">

		<?php
			if(!array_key_exists('sort',$_GET)||$_GET['sort']=='new'){
				echo '<span ng-init = "sortMethod=new;"></span>';
			}
			else{
				echo '<span ng-init = "sortMethod=good;"></span>';
			}
		?>
			<div class="tagControls">
				<p id="filters" ng-init = "getTags()">
					<span ng-repeat = "tag in tags" [id]='{{tag}}' ng-class='{inactiveTag : activeTagFilters.indexOf(tag)==-1}' ng-click='toggleTag(tag)' class = 'tag'>
						{{tag}}
					</span>
				</p>
				<input type="button" ng-click="refreshPage()" value="Refrsh with new settings"/>
			</div>
			<div id="allMemes">
				<div ng-init="getMoreMemes('');pagination=0;"></div>
			</div>

		</div>
	</body>
</html>
