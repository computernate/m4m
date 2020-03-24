<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Add meme</title>
		<link type='text/css' rel="stylesheet" href='CSS/color-picker.css' />
		<script src="JS/fabric.js"></script>
		<script src="JS/creatorScripts.js"></script>
		<script src="JS/color-picker.js"></script>
	</head>
	<body ng-controller="memectrl"  onload="initializeCanvas()">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div id="createMeme">
				<p id="creatorControls">
					<input type="file" name="fileForCreator" id="fileForCreator" onchange="addToCreator(this)">
					<label for="fileForCreator">Choose Image</label>
					<input type="button" onclick="addTextbox()" value="Add Textbox" />
					<input type="button" value="Portrait" id="changeOrientation" onclick="flipCanvas()" />
					<select id="font-family"></select>

					<span id="textControls1" class='disabled'>
				<input type="button" onclick="shrinkFont()" value="-"  id='shrinkText' />
						<input id="textColor" type='button' value = '0' />
							<input type="button" onclick="growFont()" value="+" id='growText' />
					</span>

					<span id="textControls2" class='disabled'>
						<input type="button" onclick="toggleBorder()" value="Border" id='borderToggle' />
					</span>

					<input type="button" onclick="sendElementBack()" value="Send Back" />
					<input type="button" onclick="deleteElement()" value="X" />
				</p>
				<div id="canvas-wrapper">
					<canvas id="memeCreator" width="647" height="500" >
				</div>
				<form action="PHP/submitMeme.php" method="post" enctype="multipart/form-data" class="memeOptions" name = "makeMeme" id="makeMeme" ng-submit="submitMeme()" novalidate>
					<div class="option">
						<div class="label">Title:</div>
						<input type="text" name="memeTitle" id="memeTitle" ng-model="memeTitle" maxlength="254" minlength="1" required />
					</div>
					<br />
					<div class="option">
						<div class="label">
						<input type="text" list='allTags' placeholder="Tags" name='tag' id='newTag' ng-model='actingTag' ng-init="getTags()" />
						<datalist id='allTags'>
							<option ng-repeat="tag in tags" [value]="tag">
								{{tag}}
							</option>
						</datalist>
						<button type='button' ng-click='addTag()' value='Add Tag'>Add Tag</button>
						</div>
						<input type='hidden' ng-value="stringify(activeTags)" name='atags' />
						<span class="tagOption">Tags:</tag>
						<span ng-repeat = "tag in activeTags" class="tagOption">
							{{tag}}
							<button type="button" class='delete' ng-click='deleteTag(tag)'>X</button>
						</span>
					</div>
					<br />

					<div class="option">
						<span class="label">Description:</span>
						<textarea name="memeText" id="memeText" width="400" maxlength="510" minlength="1" ng-model="memeText" required> </textarea>
					</div>

					<div class="option">
						<span class="label">Private:</span>
						<input type="checkbox" name="isPrivate" />
					</div>
					<br />
					<input type='hidden' id="uploadingMeme" name="uploadingMeme" ng-model="imageBlob" />
				<input type="submit" value="Post meme!" name="submit" id="submitMeme" ng-disabled="(!makeMeme.$valid)" />
			</form>
		</div>
	</body>
</html>
