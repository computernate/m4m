<?php
	session_start();
?>


<!--
Finished since last push
Report copy/copywright - 15
Liked pages

TO DO NEXT
User page - 19

BIG STUFF I NEED TO DO BEFORE FEB 29th
-user image
My memes - 22
Meme editor -29

LITTLE STUFF I NEED TO DO BEFORE BETA RELEASE
Show tags
about us/report bugs - 29
like actions from post
Unable to log in by pressing enter
Better meme names
Tips when submiting memes
nav tell where page is
Another table that sorts by score
Terms and conditions -29

STUFF I NEED TO DO FOR FINAL RELEASE
MOBILE FRIENDLY
Cart
My cookies
Sign in with google/fb
Link bank account
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
