<?php

	session_start();
?>

<html ng-app="money4memes">
	<head>

		<title>Cookie</title>
		<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5e83e3e224d6af001979a5f3&product=inline-share-buttons" async="async"></script>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<div id = 'singleMeme'>
				<?php
				$id = $_GET["meme"];
				$query = "SELECT * FROM memes WHERE id = '".$id."'";

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
						<h1><?php echo $row['title']; ?></h1><h2 class="color2"> by <a href='userPage.php?uid=<?php echo $name; ?>'><?php echo $name; ?></a></h2>
						<h3>Cookies bought: <?php echo $row['bought']; ?></h3>
						<img id = "mainMeme" src='Memes/<?php echo $row["id"].".png"; ?>' alt='<?php echo $row['title']; ?>' class="cookiePicture"/>

						<h3><?php echo $row["description"]; ?></h3>

						<?php
						$tags = explode(",",$row['tags']);
						if(count($tags)>0){
							for($b=0;$b<count($tags)-1;$b++){
								echo "<span class='memeTag'>".$tags[$b]." </span>";
							}
						}
						 ?>
							<table class="memeActions">
								<tr>
									<td colspan = "3">
										<div class="sharethis-inline-share-buttons"></div>
									</td>
								</tr><tr>
									<td>
										<a href = 'Memes/<?php echo $row["id"].".png"; ?>' download>Save</a>
									</td>
									<td>
										<form class="buyForm" action="https://the-memery-cookies.myshopify.com/cart/add" target="_blank" method="post" id="form<?php echo $id; ?>">
											<input type="hidden" name="id" value="32528941777028" />
											<input type="hidden" name="quantity" value="1" />
											<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
											<a href="" ng-click="buyMeme('<?php echo $id; ?>')" class="buy" >COOKIE</a>
										</form>'
									</td>
									<td>
										<a href='reportCopy.php?copyid=<?php echo $id; ?>'>Report</a>
									</td>
								</tr>
								</table>
								<?php if(isset($_SESSION["ID"])&&$row["pointerID"]==$_SESSION["ID"]){ ?>
								<table class="memeActions">
									<tr>
										<td>
											<form class="buyForm" action="https://the-memery-cookies.myshopify.com/cart/add" target="_blank" method="post" id="form<?php echo $id; ?>">
												<input type="hidden" name="id" value="32528941777028" />
												<input type="hidden" name="quantity" value="1" />
												<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
												<a href="" ng-click="buyMeme('<?php echo $id; ?>')" class="buy" >BULK COOKIES</a>
											</form>'
										</td>
										<td>
											<a href="PHP/deleteCookie.php?id=<?php echo $id; ?>">Delete</a>
										</td>
									</tr>
								</table>
								<?php } ?>

						</div>
						<div class="break"></div>

					<?php

					$queryMemes = "SELECT * FROM memes WHERE pointerID = '".$row['pointerID']."' LIMIT 0, 6;";

					$resultMemes = $conn->query($queryMemes);

					if($resultMemes->num_rows > 0) {

						?>
						<h3>Also made by <?php echo $name; ?></h3>
						<div id="simmilar">
						<?php

						$returnString="";
						while($rowMemes=mysqli_fetch_array($resultMemes)){
							echo '<div class="related"><a href = "cookie.php?meme='.$rowMemes["id"].'"><img src="Memes/'. $rowMemes["id"].".png".'" alt="'.$rowMemes['title'].'" /></a></div>';
						}
						?>
						</div>
						<?php
					}
					else{
						echo 'This user was not found';
					}


					$query3 = "SELECT * FROM comments WHERE memeid='".$id."';";


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
