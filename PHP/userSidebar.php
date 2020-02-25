
<form id='submitUserImage' method="post" action="PHP/submitUserImage.php" enctype="multipart/form-data">
	<label for="userImageFile">
		<div class="userimagewrapper">
			<img class='userimgside' src='userImages/<?php echo $_SESSION["ID"].".".$_SESSION["filetype"]; ?>' alt='<?php echo $_SESSION['user']; ?>'/>
			<div id="changeImageText"><h4>Change Image</h4></div>
		</div>
	</label>
	<input type="file" id="userImageFile" name="userImageFile" onchange="form.submit()" />
</form>

<?php
	echo "<h2>Welcome ".$_SESSION["user"]."!</h2>";
?>


<div>
	<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"newMeme.php")!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>>
			<a href='newMeme.php?failure='>New meme</a>
	</p>

	<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"notifications.php")!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href=''>Notifications</a>
	</p>

	<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"userPage.php")!=false&&strpos($_SERVER['REQUEST_URI'],$_SESSION["ID"])!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href='userPage.php?uid=<?php echo $_SESSION["ID"]; ?>'>My Memes</a>
	</p>

	<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"likedImages.php")!=false&&strpos($_SERVER['REQUEST_URI'],$_SESSION["ID"])!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href='likedImages.php?likedBy=<?php echo $_SESSION["ID"];?>'>Liked Memes</a>
	</p>

	<p><a href='' ng-click='logOut()' >Log Out</a></p>

</div>
