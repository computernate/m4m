<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Quick Cookie</title>
		<script src="JS/fabric.js"></script>
	   <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div class="genericBlock">
        <h1>BUY COOKIE</h1>
        <p>Upload a picture to get started!</p>
        <p>Note: For more editing options (including landscape), to save cookies, and to resell through our website, click the M in the corner to make an account!</p>
				<p>Note 2, revenge of the sith: After uploading a photo, drag it around to move the image</p>
      	<div class="quickCookieUploadDiv">
					<input type="file" name="quickCookieUpload" id="quickCookiePortraitUpload" class="quickCookieUpload" onchange="addToQuick(this)">
        	<label for="quickCookiePortraitUpload" class="quickCookieButton">Upload Image</label>
				</div>
        <div id="addQuickCookies">

        </div>
			</div>
    </div>
		<form action="PHP/submitMeme.php" method="post" enctype="multipart/form-data" class="hiddenForm" name = "makeMeme" id="makeMeme" ng-submit="submitMeme()" novalidate>
						<input type="hidden" name="memeTitle" id="memeTitle" ng-model="memeTitle" maxlength="254" minlength="1" placeholder = "required" required />
						<input type='hidden' ng-value="stringify(activeTags)" name='atags' value="" />
						<input name="memeText" type="hidden" id="memeText" ng-model="memeText" value=""> </textarea>
						<input type='hidden' id="uploadingMeme" name="uploadingMeme" />
						<input type='checkbox' name="isPrivate" id="isPrivate" width="400" ng-model="isPrivate" checked />
		</form>
  </body>
</html>
