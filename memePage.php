<?php
	
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title></title>
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
					
					
						<h1><?php echo $row['title']; ?></h1><h2> by <?php echo $name; ?></h2>
						<h3>Likes: <?php echo $row['likes']; ?> <span id="score" title="Score is a measure of how popular you are at the moment. It raises for likes and Tshirt buys, but lowers over time.">Score: <?php echo $row['score']; ?></span></h3>
						<img id = "mainMeme" src='memes/<?php echo $row["id"].".".$row["fileType"]; ?>' alt='<?php echo $row['title']; ?>' />
						
						<h3><?php echo $row["description"]; ?></h3>
						
					<div class="break"></div>
					<?php

					
					$queryMemes = "SELECT * FROM memes WHERE pointerID = '".$row['pointerID']."' ORDER BY score LIMIT 0, 6;";

					$resultMemes = $conn->query($queryMemes);

					if($resultMemes->num_rows > 0) {
						
						?>
						<h3>Also made by <?php echo $name; ?></h3>
						<div id="simmilar">
						<?php
						
						$returnString="";
						while($rowMemes=mysqli_fetch_array($resultMemes)){
							echo '<div class="related"><a href = "memePage.php?meme='.$rowMemes["id"].'"><img src="memes/'. $rowMemes["id"].".".$rowMemes["fileType"].'" alt="'.$rowMemes['title'].'" /></a></div>';
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
					
					<div id="comments">
					<h2>COMMENTS</h2>
					<textarea class='comment' id='comment<?php echo $row["id"] ?>' ></textarea>
					<input type='button' ng-click='submitComment("<?php echo $row["id"] ?>")' value= 'Submit Comment' id='subbut<?php echo $row["id"] ?>' />
					<?php
					if($result3->num_rows > 0) {
						?>
							<?php 
							while($row3=mysqli_fetch_array($result3)){
								?><a href='viewUser.php?id=<?php echo $row3["userid"] ?>' ><?php echo $row3["name"] ?></a>
									<p><?php echo $row3["comment"] ?></p>
									<div class='break'></div>
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