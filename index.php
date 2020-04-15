<?php
	session_start();
?>

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


		 <div id="intro" class='genericBlock'>
			 <h1>Welcome to Merchies Cookies!</h1>
			 <p>Merchandising is hard. Here at Merchies Cookies, we've tried to create the perfect merchandising experience for you by fixing the 3 hardest parts:</p>
			 <ol>
				<li>
					<span class='color2'>NO INVESTMENT:</span> At Merchies, we take care of everything so there is <span>zero investment</span>. We only print cookies when the order is placed, send the cookies directly to the customer,
					 and send you	your hard earned revenue. </li>
				<li>
					<span class='color2'>EASY:</span> All you do is upload a picture! Then you can post the link wherever you want, and receive your revenue. We take care of hosting, printing, and shipping.
					Its so easy to use, <span>you'll make money on accident!</span></li>
				<li>
					<span class='color2'>UNIQUE:</span> If you wanted a T shirt of a mug, you can go anywhere. But nowhere else will bring you fresh, home-baked, <span>high-quality cookies</span>.
				</li>
			 </ol>
			 <p>Click the M in the corner to create an account and get started, or see our most popular cookies below!</p>
		 </div>

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

				<input type="button" ng-click="refreshPage()" value="See cookies with highlighted tags"/>
			</div>
			<div id="allMemes">
				<div ng-init="getMoreMemes('');pagination=0;"></div>
			</div>

		</div>
	</body>
</html>
