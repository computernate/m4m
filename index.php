<?php
	session_start();
?>

<html ng-app="merchies">
	<head>
		<title>Quick Cookie</title>
		<script src="JS/fabric.js"></script>
	   <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
	</head>
	<body ng-controller="merchiesctrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div class="genericBlock">
        <h1>COOKIE TYPE</h1>
        <p>Click to select</p>
        <table class='homeTable'>
					<tr>
						<td ng-init = "CookieVisible = true" ng-click="CookieVisible=!CookieVisible"><img src="Images/Events.jpg" /></td>
						<td ng-click="activatedFullNav=!activatedFullNav"><img src="Images/Resell.jpg" /></td>
					</tr>
				</table>
      	<div class="quickCookieUploadDiv" ng-hidden="CookieVisible">
					<input type="file" name="quickCookieUpload" id="quickCookiePortraitUpload" class="quickCookieUpload" onchange="addToQuick(this)">
        	<label for="quickCookiePortraitUpload" class="quickCookieButton">Vertical Cookie</label>
				</div>
      	<div class="quickCookieUploadDiv" ng-hidden="CookieVisible">
					<input type="file" name="quickCookieUpload" id="quickCookieLandscapeUpload" class="quickCookieUpload" onchange="addToQuick(this)">
        	<label for="quickCookieLandscapeUpload" class="quickCookieButton">Horizontal Cookie</label>
				</div>
        <div id="addQuickCookies">

        </div>
			</div>
    </div>
		<form action="PHP/submitCookie.php" method="post" enctype="multipart/form-data" class="hiddenForm" name = "makeCookie" id="makeCookie" novalidate>
						<input type="hidden" name="imageTitle" id="imageTitle" ng-model="imageTitle" maxlength="254" minlength="1" placeholder = "required" required />
						<input type='hidden' ng-value="stringify(activeTags)" name='atags' value="" />
						<input name="imageText" type="hidden" id="imageText" ng-model="imageText" value=""> </textarea>
						<input type='hidden' id="uploadingImage" name="uploadingImage" />
						<input type='hidden' id="comingFromHome" name="comingFromHome" value="1" />
						<input type='checkbox' name="isPrivate" id="isPrivate" width="400" ng-model="isPrivate" checked />
		</form>
  </body>
</html>
