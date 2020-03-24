
<?php
	$id=$_SESSION["ID"];
	$earningsquery = "SELECT earnings, bankingID FROM users WHERE id='$id';";

	$result = $conn->query($earningsquery);

	//echo $result;
	$bankingID;
	$earnings;
	$filetype;
	if($result->num_rows > 0) {
		while($row=mysqli_fetch_array($result)){
			$earnings = $row["earnings"];
			$filetype=$_SESSION["filetype"];
			$bankingID=$row["bankingID"];
		}
	}
?>

<form id='submitUserImage' method="post" action="PHP/submitUserImage.php" enctype="multipart/form-data">
	<label for="userImageFile">
		<div class="userimagewrapper">
			<img class='userimgside' src='userImages/<?php echo $id.".".$filetype; ?>' alt='<?php echo $_SESSION['user']; ?>'/>
			<div id="changeImageText"><h4>Change Image</h4></div>
		</div>
	</label>
	<input type="file" id="userImageFile" name="userImageFile" onchange="form.submit()" />
</form>
<?php	echo "<h2>Welcome ".$_SESSION["user"]."!</h2>"; ?>

<h3 id="earnings" title = 'This goes up when your cookies ship out. Be sure to post about it on social media to get more people to buy!'>
	<a href='changeEarningsInfo.php' class="money">$<?php echo number_format((float)$earnings, 2, '.', ''); ?></a>
		<?php if($bankingID=="") { ?>
		<h4>Add/change earnings method by clicking above</h4>
	<?php } ?>
</h3>

<div>
	<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"newMeme.php")!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
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
			<a href='likedImages.php?likedBy=<?php echo $_SESSION["ID"];?>' >Liked Memes</a>
	</p>
		<p><a href='' ng-click='submitToCart()' >Cart</a></p>

	<p><a href='' ng-click='logOut()' >Log Out</a></p>

	<form method="post" action="https://the-memery-cookies.myshopify.com/cart" id="cartForm" />
		<input type="text" id="cartFormData" name="cartFormData" />
	</form>
</div>
