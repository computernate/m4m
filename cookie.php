<?php

	session_start();

?>

<html ng-app="merchies">
	<head>

		<title>Cookie</title>
		<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5e83e3e224d6af001979a5f3&product=inline-share-buttons" async="async"></script>
	</head>
	<body ng-controller="merchiesctrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div id = 'singleCookie'>
				<?php
				$id = $_GET["cookie"];
				$query = "SELECT * FROM images WHERE id = '".$id."'";

				$result = $conn->query($query);

				if($result->num_rows > 0) {
					$returnString="";
					while($row=mysqli_fetch_array($result)){
						$query2 = "SELECT name FROM users WHERE id = '".$row['pointerID']."'";

						$result2 = $conn->query($query2);
						$name = "";
						if($result2->num_rows > 0) {
							$returnString="";
							while($row2=mysqli_fetch_array($result2)){
								$name=$row2['name'];
							}
						}
						else{
							echo 'This user was not found';
						}
						?>
						<div class="genericBlock">
							<?php
							$sameUser;
							(isset($_SESSION["ID"])&&$row["pointerID"]==$_SESSION["ID"])?$sameUser=true:$sameUser=false;
							if($sameUser||$row["private"]!=1){
							?>
						<h1><?php echo $row['title']; ?></h1><h2 class="color2"> by <a href='userPage.php?uid=<?php echo $name; ?>'><?php echo $name; ?></a></h2>
						<h3>Cookies bought: <?php echo $row['bought']; ?></h3>
						<img id = "mainCookie" src='userCookies/<?php echo $row["id"].".png"; ?>' alt='<?php echo $row['title']; ?>' class="cookiePicture"/>

						<h3><?php echo $row["description"]; ?></h3>

						<?php
						$tags = explode(",",$row['tags']);
						if(count($tags)>0){
							for($b=0;$b<count($tags)-1;$b++){
								echo "<span class='imageTag'>".$tags[$b]." </span>";
							}
						}
						 ?>
								<?php if($sameUser){ ?>
									<div class="buyWrapper">
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33536730759300)">HUGE (1.99)</p>
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33536730792068)">NORMAL (1.25)</p>
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33536730824836)">PARTY (1.99)</p>
									</div>
									<div class="buyWrapper">
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33536767328388)">HUGE (6)</p>
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>,'33536767361156)">NORMAL (12)</p>
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33536767426692)">PARTY (24)</p>
									</div>
								<?php } else{ ?>
									<div class="buyWrapper">
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33456487858308)">HUGE (2.99)</p>
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33456487891076)">NORMAL (1.99)</p>
										<p class="buy" ng-click="buyCookie('<?php echo $id; ?>',33456487923844)">PARTY (2.99)</p>
									</div>
								<?php }
							}
							else{ ?>
								<p>This cookie is only for private purposes and is not for purchase.</p>
							<?php } ?>
						</div>
						<div class="break"></div>

					<?php

					$queryImages = "SELECT * FROM images WHERE pointerID = '".$row['pointerID']."' LIMIT 0, 6;";

					$resultImages = $conn->query($queryImages);

					if($resultImages->num_rows > 0) {

						?>
						<h3>Also made by <?php echo $name; ?></h3>
						<div id="simmilar">
						<?php

						$returnString="";
						while($rowImages=mysqli_fetch_array($resultImages)){
							echo '<div class="related"><a href = "cookie.php?cookie='.$rowImages["id"].'"><img src="userCookies/'. $rowImages["id"].".png".'" alt="'.$rowImages['title'].'" /></a></div>';
						}
						?>
						</div>
						<?php
					}
					else{
						echo 'This user was not found';
					}


					$query3 = "SELECT * FROM comments WHERE imageId='".$id."';";


					$result3 = $conn->query($query3);

					?>

					<div class="break"></div>

					<div id="comments" class="genericBlock">
					<h2>COMMENTS</h2>
					<textarea class='comment' id='comment<?php echo $row["id"] ?>' ></textarea>
					<input type='button' ng-click='submitComment("<?php echo $row["id"] ?>")' value= 'Submit Comment' id='subbut<?php echo $row["id"] ?>' />
					<div id="commentsFor<?php echo $id; ?>"></div>
					<?php
					if($result3->num_rows > 0) {
						?>
							<?php
							while($row3=mysqli_fetch_array($result3)){
								?>
								<div class='commentBreak'></div>
								<a href='userPage.php?id=<?php echo $row3["userid"] ?>' ><?php echo $row3["name"] ?></a>
								<p><?php echo $row3["comment"] ?></p>
							<?php
							}
					}
					?>
					</div>
					<?php
				}
			}
			?>
			</div>
		</div>
	</body>
</html>
