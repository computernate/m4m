<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Merchies</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
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
		 if(!isset($_GET["sort"])){
		  ?>
		 <div id="intro" class='genericBlock'>

			 <h1>Welcome to Merchies Cookies!</h1>
			 <p>We create custom printed cookies, and sell them all over the country! Perfect for:</p>
			 <ul>
				<li>
					<span class='color2'>PARTIES</span> From baby showers, college parties, to weddings, funerals, and everything in between!
				 		Custom printed cookies make a beautiful custom decoration, and party favor that everyone will appreciate</li>
				<li>
					<span class='color2'>GIFTS</span> Turn someone's favorite moment into a great gift! They will truly appreciate seeing
						a family photo, a great achievement, or an old memory on a delicious cookie!</li>
				<li>
					<span class='color2'>MERCHANDISING</span> If you wanted a T shirt or a mug, you can go anywhere. But nowhere else will bring you fresh, home-baked, high-quality cookies.
				</li>
				<li>
					<span class='color2'>ART</span> If you're an artist, photographer, or even a band, make money through your craft with us! We'll take care of your
						orders, and even host for you so all you need to do is post a picture, and share your link!
				</li>
			</ul>
			 <p><span ng-click="activatedFullNav=!activatedFullNav">Click here</span> or the M in the corner to create an account and get started!</p>
			 <img src="Images/wedding.jpg" style="width:100%;margin-top:5px;"/>
			 <img src = "Images/merch.jpg" style="width:100%;margin-top:5px;"/>
		 </div>
	 <?php }else{ ?>
		 <div id="allMemes">
			 <div ng-init="getMoreMemes()"></div>
		 </div>
	 <?php }?>
		</div>
	</body>
</html>
