<?php
	session_start();
?>


<!--
Finished since last push
nav tell where page is
Better meme names
Show tags
Meme editor

TO DO NEXT by saturday
Another table that sorts by score
sort by date broken
Make tags work

BIG STUFF I NEED TO DO BEFORE FEB 29th
Report Content
Delete Meme

LITTLE STUFF I NEED TO DO
Save tags in a cookie
like actions from post
search by user
Email validation broken

STUFF I NEED TO DO BEFORE BETA RELEASE (April 1st)
Cart -3/6
Link bank account / paypal / Venmo -3/10
Notifications -3/11
Share to FB/Instagram 3/12
Sign in with google/fb -3/14
Better design overall -3/21
MOBILE FRIENDLY!!!!!!!! -3/28
Terms and conditions  -3/31
about us/report bugs -3/31

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
				echo '<span ng-init = "sortMethod=\'new\';"></span>';
			}
			else{
				echo '<span ng-init = "sortMethod=\'good\';"></span>';
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
