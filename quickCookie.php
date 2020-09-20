<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Quick Cookie</title>
	   <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div class="genericBlock">
        <h1>BUY COOKIE</h1>
        <p>Upload a picture to get started!</p>
        <p>Note: For more editing options (including landscape), to save cookies, and to resell through our website, click the M in the corner to make an account!</p>
      	<div>
					<input type="file" name="quickCookieUpload" id="quickCookiePortraitUpload" class="quickCookieUpload" onchange="angular.element(this).scope().addToQuick(event)">
        	<label for="quickCookiePortraitUpload" class="quickCookieButton">Upload Image</label>
				</div>
        <div id="addQuickCookies">
          <div class="quickCookie" ng-repeat="image in quickImages">
						<div class='quickCookieWrapper'>
            	<img src='{{image}}' class="quickCookieImage" id="cookie{{$index}}" />
						</div>
						<div class="buyWrapper">
							<p class="buy" ng-click="buyCookiesQuick('{{$index}}',33536730759300)">HUGE (1.99)</p>
							<p class="buy" ng-click="buyCookiesQuick('{{$index}}',33536730792068)">NORMAL (1.25)</p>
							<p class="buy" ng-click="buyCookiesQuick('{{$index}}',33536730824836)">PARTY (1.99)</p>
						</div>
          </div>
        </div>
				<br />
				<br />
			</div>
    </div>
  </body>
</html>
