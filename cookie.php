<?php

	session_start();

?>

<html ng-app="money4memes">
	<head>

		<title>Cookie</title>
		<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
							<?php
							$sameUser;
							(isset($_SESSION["ID"])&&$row["pointerID"]==$_SESSION["ID"])?$sameUser=true:$sameUser=false;
							if($sameUser||$row["private"]!=1){
							?>
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
									<?php if($sameUser){ ?>

										<!--<td>
											<div class="buyForm">
												<a href="" ng-click="buyCookie('33536730759300', '<?php echo $id; ?>')" class="buy">ENORMOUS ($2.99)</a>
											</div>
										</td>

										<td>
											<div class="buyForm">
												<a href="" ng-click="buyCookie('33536730792068', '<?php echo $id; ?>')" class="buy">NORMAL ($1.49)</a>
											</div>
										</td>
										<td>
											<div class="buyForm">
												<a href="" ng-click="buyCookie('33536730824836', '<?php echo $id; ?>')"  class="buy">PARTY ($2.99) </a>
											</div>
										</td>-->
										<td>
											<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formsl<?php echo $id; ?>">
												<input type="hidden" name="id" value="33536730759300" />
												<input type="hidden" name="quantity" value="1" />
												<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
												<a href="" ng-click="buyCookie('sl<?php echo $id; ?>')" class="buy" >ENORMOUS ($1.99) </a>
											</form>
										</td>
									<td>
										<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formsm<?php echo $id; ?>">
											<input type="hidden" name="id" value="33536730792068" />
											<input type="hidden" name="quantity" value="1" />
											<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
											<a href="" ng-click="buyCookie('sm<?php echo $id; ?>')" class="buy" >NORMAL ($1.25)</a>
										</form>
									</td>
									<td>
										<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formss<?php echo $id; ?>">
											<input type="hidden" name="id" value="33536730824836" />
											<input type="hidden" name="quantity" value="1" />
											<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
											<a href="" ng-click="buyCookie('ss<?php echo $id; ?>')" class="buy" >PARTY ($1.99) </a>
										</form>
									</td>
								<?php } else{ ?>
									<td>
										<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formsl<?php echo $id; ?>">
											<input type="hidden" name="id" value="33456487858308" />
											<input type="hidden" name="quantity" value="1" />
											<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
											<a href="" ng-click="buyCookie('sl<?php echo $id; ?>')" class="buy" >ENORMOUS ($2.99) </a>
										</form>
									</td>
								<td>
									<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formsm<?php echo $id; ?>">
										<input type="hidden" name="id" value="33456487891076" />
										<input type="hidden" name="quantity" value="1" />
										<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
										<a href="" ng-click="buyCookie('sm<?php echo $id; ?>')" class="buy" >NORMAL ($1.99)</a>
									</form>
								</td>
								<td>
									<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formss<?php echo $id; ?>">
										<input type="hidden" name="id" value="33456487923844" />
										<input type="hidden" name="quantity" value="1" />
										<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
										<a href="" ng-click="buyCookie('ss<?php echo $id; ?>')" class="buy" >PARTY ($2.99) </a>
									</form>
								</td>
								<?php } ?>
								</tr>
								</table>
								<?php if($sameUser){ ?>
								<table class="memeActions">
									<td>
										<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formbl<?php echo $id; ?>">
											<input type="hidden" name="id" value="33536767328388" />
											<input type="hidden" name="quantity" value="1" />
											<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
											<a href="" ng-click="buyCookie('bl<?php echo $id; ?>')" class="buy" >BIG BULK (6)</a>
										</form>
									</td>
								<td>
									<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formbm<?php echo $id; ?>">
										<input type="hidden" name="id" value="33536767361156" />
										<input type="hidden" name="quantity" value="1" />
										<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
										<a href="" ng-click="buyCookie('bm<?php echo $id; ?>')" class="buy" >NORMAL BULK (12)</a>
									</form>
								</td>
								<td>
									<form class="buyForm" action="https://merchies-shop.com/cart/add" target="_blank" method="post" id="formbs<?php echo $id; ?>">
										<input type="hidden" name="id" value="33536767426692" />
										<input type="hidden" name="quantity" value="1" />
										<input type="hidden" name="properties[cookieid]" value="<?php echo $id; ?>" />
										<a href="" ng-click="buyCookie('bs<?php echo $id; ?>')" class="buy" >SMALL BULK (24)</a>
									</form>
								</td>
								</table>
								<?php }
							}
							else{ ?>
								<p>This cookie is only for private purposes and is not for purchase.</p>
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
