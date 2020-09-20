<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Quick Cookie</title>
		<script src="JS/fabric.js"></script>
	   <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
		 				<script>
		 					var testQuickAjax=function(){
							$.get("/PHP/addCookie.php",
								{
									id: "weddingidk",
									size: "33536730824836"
								},
								function(data, status){
									console.log("Data: " + data + "\nStatus: " + status);
								});
							}
		 				</script>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div class="genericBlock">
        <h1>BUY COOKIE</h1>
        <p>Note: For more editing options, to save cookies, and to resell through our website, click the M in the corner to make an account!</p>
        <input type="file" name="quickCookieImage" id="quickCookieImage" onchange="addToQuick(this)">
        <label for="fileForCreator" class="centerCreate">Choose Images</label>

        <div id="addQuickCookies">

        </div>

				<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="thecookie">
					<input type="hidden" name="id" value="33536730759300" />
					<input type="hidden" name="quantity" value="1" />
					<input type="hidden" name="properties[cookieid]" value="weddingidk" />
					<a href="" ng-click="buyCookieQuick('thecookie')" class="buy" >ENORMOUS ($1.99) </a>
				</form>

				<a href="" onclick="testQuickAjax()" class="buy" >ENORMOUS (0) </a>
			</div>
    </div>
  </body>
</html>
