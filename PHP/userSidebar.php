

<?php
	echo "<h2>WELCOME ".$_SESSION["user"]."</h2>";
?>


<div>
	<p><a href='newMeme.php?failure='>New meme</a></p>
	<p><a href=''>Notifications</a></p>
	<p><a href=''>My Memes</a></p>
	<p><a href='likedImages.php?likedBy=<?php echo $_SESSION["ID"];?>'>Liked Memes</a></p>
	<p><a href='' ng-click='logOut()' >Log Out</a></p>
</div>
