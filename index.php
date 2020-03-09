<?php
	session_start();
?>


<!--
Finished since last push
sort by date works
Another table that sorts by score
Cart

LITTLE STUFF I NEED TO DO
like actions from post
search by user
Email validation broken
Score
Make tags work
Save tags in a cookie

UX and cart (April 1st)
Link bank account / paypal / Venmo -3/10
Share to FB/Instagram 3/12
Sign in with google/fb -3/14
Better design overall -3/21
MOBILE FRIENDLY!!!!!!!! -3/28
Terms and conditions  -3/31
about us/report bugs -3/31

ADMIN THINGS (May 1st)
Notifications
Report Content
Delete Meme

-->


<html ng-app="money4memes">
	<head>
		<title>The Memery</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">

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
					<span ng-repeat = "tag in tags" [id]='{{tag}}' ng-class='{inactiveTag : activeTagFilters.indexOf(tag)==-1}' ng-click='toggleTag(tag)' class = 'tag'>
						{{tag}}
					</span>
				</p>
				<input type="button" ng-click="refreshPage()" value="Refrsh with new settings"/>
			</div>
			<form action="https://the-memery-cookies.myshopify.com/cart/add" target="_blank" method="post" id="form1"/>';
			<input type="hidden" name="id" value="32528941777028" />
			<input type="hidden" name="quantity" value="1" />
			<input type="hidden" name="properties[memeid]" value="1" />
			<a href="" ng-click="buyMeme('Underwater_homework')">Buy!</a>
		</form>
			<div id="allMemes">
				<div ng-init="getMoreMemes('');pagination=0;"></div>
			</div>

		</div>
	</body>
</html>
