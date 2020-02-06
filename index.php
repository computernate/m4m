<?php
	session_start();
?>


<!--
Test commiting

TO DO NEXT
Search
head notifications


BIG STUFF I NEED TO DO BEFORE BETA RELEASE

Report copy/copywright
-admin
Liked pages
My memes
User page
-user image
Unable to log in by pressing enter

LITTLE STUFF I NEED TO DO BEFORE BETA RELEASE
Fix filter
log out
about us/report bugs
like from post

STUFF I NEED TO DO FOR FINAL RELEASE
Meme editor
Cart
My cookies
Sign in with google/fb
Link bank account
Top dozen (By tag as well)

Phase 2
Business tools
-Wordpress pages
-Shopify pages
-Top 12 cookie sheets
-DEV API

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
				<div ng-init="getMoreMemes()"></div>
			</div>

		</div>
	</body>
</html>
