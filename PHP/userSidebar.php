
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
			if(isset($_SESSION["fileType"])){
				$filetype=$_SESSION["fileType"];
			}
			$bankingID=$row["bankingID"];
		}
	}
?>

<form id='submitUserImage' method="post" action="PHP/submitUserImage.php" enctype="multipart/form-data" id="userImageWrapper">
	<label for="userImageFile">
		<div class="userimagewrapper">
			<?php
				if(isset($_SESSION["fileType"])&&$_SESSION["fileType"]!=""){
			 ?>
			<img class='userimgside' src='userImages/<?php echo $id.".".$filetype; ?>' alt='<?php echo $_SESSION['user']; ?>'/>
			<div id="changeImageText"><h4>Change Image</h4></div>
			<?php }
				else{ ?>
 					<img class='userimgside' src='userImages/noImage.png' alt='<?php echo $_SESSION['user']; ?>'/>
 					<div id="changeImageText"><h4>Change Image</h4></div>
				<?php } ?>
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

	<p class="mobileNav"
		<?php
			if(!isset($_GET["sort"])&&strpos($_SERVER['REQUEST_URI'],"index.php")!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href="index.php">Popular Cookies</a>
			</p>
			<p  class="mobileNav"
			<?php
				if(strpos(isset($_GET["sort"])&&$_SERVER['REQUEST_URI'],"index.php")!=false){
					echo "style='background-color:var(--head-nav-bg-color-2);'";
				} ?>
				>
				<a href="index.php?sort=new">Fresh Cookies</a>
		</p>
		<p id="mobileJar" class="mobileNav">
			<a href='https://merchies-shop.com/cart'>Cookie Jar</a>
		</p>
		<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"newCookie.php")!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href='newCookie.php?failure='>New Cookie</a>
	</p>

	<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"notifications.php")!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href='notifications.php'>Notifications</a>
	</p>

	<p
		<?php
			if(strpos($_SERVER['REQUEST_URI'],"userPage.php")!=false&&strpos($_SERVER['REQUEST_URI'],$_SESSION["ID"])!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href='userPage.php?uid=<?php echo $_SESSION["ID"]; ?>'>My Cookies</a>
	</p>


	<p><a href='' ng-click='logOut()' >Log Out</a></p>

	<form method="post" action="https://the-memery-cookies.myshopify.com/cart" id="cartForm" />
		<input type="text" id="cartFormData" name="cartFormData" />
	</form>
</div>

<a href="terms-and-conditions.php" id="TandC">Terms and Conditions</a>
