<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>New Cookie</title>
		<link type='text/css' rel="stylesheet" href='CSS/color-picker.css' />
		<script src="JS/fabric.js"></script>
		<script src="JS/creatorScripts.js"></script>
		<script src="JS/color-picker.js"></script>
	</head>
	<body ng-controller="memectrl"  onload="initializeCanvas()">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<!--<div id="createMeme">-->
			<div class="genericBlock" id="createMeme">
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
					<table>
						<tr>
							<td>
								<span>Title:</span>
							</td>
							<td>
								<input type="text" name="memeTitle" id="memeTitle" ng-model="memeTitle" maxlength="254" minlength="1" required />
							</td>
						</tr>
						<tr>
							<td>
								<span>Tags:</span>
							</td>
							<td>
								<input type="text" list='allTags' placeholder="Select or create a tag" name='tag' id='newTag' ng-model='actingTag' ng-init="getTags()" />
								<input type='hidden' ng-value="stringify(activeTags)" name='atags' />

								<datalist id='allTags'>
									<option ng-repeat="tag in tags" [value]="tag">
										{{tag}}
									</option>
								</datalist>

								<button type='button' ng-click='addTag()' value='Add Tag'>Add Tag</button>
								<span ng-repeat = "tag in activeTags" class="tagOption">
									{{tag}}
									<button type="button" class='delete' ng-click='deleteTag(tag)'>X</button>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<span>Description:</span>
							</td>
							<td>
							<textarea name="memeText" id="memeText" width="400" maxlength="510" minlength="1" ng-model="memeText" required> </textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type='hidden' id="uploadingMeme" name="uploadingMeme" ng-model="imageBlob" />
								<?php if($bankingID=="") { ?>
										<h3 class="earningsError">You need to add an earnings method before posting a cookie. Please go to the user side bar, and click the $0.00 to add one.</h3>
								<?php }
								else{ ?>
										<input type="submit" value="Post cookie!" name="submit" id="submitMeme" ng-disabled="(!makeMeme.$valid)" />
								<?php } ?>
							</td>
						</tr>
					</table>
				</form>
		</div>
	</body>
</html>
