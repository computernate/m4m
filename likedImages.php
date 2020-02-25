<?php
session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>The Memery</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">

      <div id="searchQuery">
        <h2>
          <?php
            if(isset($_GET["likedBy"])){
              echo "MY LIKED MEMES";
            }
            else{
              echo "AN ERROR HAS OCCURED. PLEASE TRY AGAIN</h2>";
                echo "<h2>But only if you want I guess. I'm a computer, not your mom";
            }
          ?>
        </h2>
      </div>

      <div id="allMemes">
				<div ng-init="getMoreMemes('&likedBy=<?php echo $_GET['likedBy'] ?>')"></div>
			</div>
    </div>
    <h4>
      You should try liking more memes!
    </h4>
  </body>
</html>
