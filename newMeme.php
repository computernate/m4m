<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Add meme</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
		<?php
			if($_GET['failure']){
				echo $_GET['failure'];
			}
		?>
		<form action="PHP/submitMeme.php" method="post" enctype="multipart/form-data" id="createMeme">
			<table>
				<tr>
					<td>Select image to upload:</td>
					<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
				</tr>
				
				<tr>
					<td>Title:</td>
					<td><input type="text" name="title" />
				</tr>
				<tr>
					<td>Text (for searching purposes):</td>
					<td><input type="text" name="text" />
				</tr>
					<td>
						<input type="text" list='allTags' placeholder="Tags" name='tag' id='newTag' ng-model='actingTag' ng-init="getTags()" />
							<datalist id='allTags'>
								<option ng-repeat="tag in tags" [value]="tag">
									{{tag}}
								</option>
							</datalist>
						<button type='button' ng-click='addTag()' value='Add Tag'>Add Tag</button>
					</td>
					
					<td>
						<input type='hidden' ng-value="stringify(activeTags)" name='atags' />
						<p ng-repeat = "tag in activeTags">
							{{tag}}
							<button type="button" class='delete' ng-click='deleteTag(tag)'>X</button>
						</p>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Post meme!" name="submit"></td>
				</tr>
			</table>
		</form>
		
		</div>
	</body>
</html>