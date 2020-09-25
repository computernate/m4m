<?php
///Editor for new image
///Nathan Roskelley September 2020
	session_start();
?>

<html ng-app="merchies">
	<head>
		<title>New Cookie</title>
		<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
		<link type='text/css' rel="stylesheet" href='CSS/color-picker.css' />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="JS/fabric.js"></script>
		<script src="JS/creatorScripts.js"></script>
		<script src="JS/color-picker.js"></script>
		<style>

			.centerCreate{
				padding:5px;
				margin-left:auto;
				margin-right:auto;
			}

			label{
				display:block;
				text-align:center;
				font-size:40px;
				border:solid white 4px;
				padding:20px;
			}

			h1{
				font-size:50px;
			}

		</style>
	</head>
	<body ng-controller="merchiesctrl"  onload="initializeCanvas()">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div class="genericBlock" id="create">
				<h1 style = "text-align:center">Create New Cookie</h1>
				<div id="creatorControls">
					<input type="file" name="fileForCreator" id="fileForCreator" onchange="addToCreator(this)">
					<label for="fileForCreator" class="centerCreate">Choose Image</label>
					<br />
					<br />
					<input type="button" value="Change to Portrait" id="changeOrientation" onclick="flipCanvas()"  class="centerCreate"/>
					<input type="button" onclick="addTextbox()" value="Add Textbox" />
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
				</div>



				<div id="canvas-wrapper">
					<canvas id="ImageCreator" width="450" height="300" >
				</div>




				<form action="PHP/submitCookie.php" method="post" enctype="multipart/form-data" class="imageOptions" name = "makeCookie" id="makeCookie" ng-submit="submitImage()" novalidate>
					<table>
						<tr>
							<td>
								<span>Title:</span>
							</td>
							<td colspan="2">
								<input type="text" name="imageTitle" id="imageTitle" ng-model="imageTitle" maxlength="254" minlength="1" placeholder = "required" required />
							</td>
						</tr>
						<tr>
							<td>
								<span>Tags:</span>
							</td>
							<td colspan="2">
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
							<td colspan="2">
								<textarea name="imageText" id="imageText" width="400" maxlength="510" minlength="1" ng-model="imageText"> </textarea>
							</td>
						</tr>
						<tr>
							<td>
								<span>Private</span>
							</td>
							<td>
								<input type='checkbox' name="isPrivate" id="isPrivate" width="400" ng-model="isPrivate" />
							</td>
								<td>
									<span id="leaveunchecked">Leave unchecked for others to see and buy this cookie</span>
								</td>
						</tr>
						<tr>
							<td colspan="3">
								<input type='hidden' id="uploadingImage" name="uploadingImage" ng-model="imageBlob" />
								<?php if($bankingID=="") { ?>
										<h3 class="earningsError" ng-show='!isPrivate'>You need to add an earnings method before posting a cookie for resell. Please go to the user side bar, and click the $0.00 to add one or make your cookie private.</h3>
										<input type="submit" value="Post cookie!" name="submit" id="submitCookie" ng-disabled="(!makeCookie.$valid)" ng-show="isPrivate" />
								<?php }
								else{ ?>
										<input type="submit" value="Create cookie!" name="submit" id="submitCookie" ng-disabled="(!makeCookie.$valid)" />
								<?php } ?>
							</td>
						</tr>
					</table>
				</form>
		</div>
	</body>
</html>
