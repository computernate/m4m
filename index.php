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
        <h1>BUY COOKIE</h1>
        <p>Upload a picture to get started!</p>
        <p>Note 1 and the philosopher's stone: For more editing options (including landscape), to save cookies, and to resell through our website, click the M in the corner to make an account!</p>
				<p>Note 2, revenge of the sith: After uploading a photo, drag it around to move the image</p>
				<p>Note 3, fallen kingdom: Examples of cookies and public cookies for purchase can be seen under "cookie"</p>
      	<div class="quickCookieUploadDiv">
					<input type="file" name="quickCookieUpload" id="quickCookiePortraitUpload" class="quickCookieUpload" onchange="addToQuick(this)">
        	<label for="quickCookiePortraitUpload" class="quickCookieButton">Upload Image</label>
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
