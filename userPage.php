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
      <?php
        if(!isset($_GET["uid"])){
          echo "No user selected.";
        }
        else{
          $user=$_GET["uid"];
          $sql = "SELECT * FROM users WHERE id = '$user';";

          $result = $conn->query($sql);

          if($result->num_rows > 0) {
        	while($userData=mysqli_fetch_array($result)){
      ?>

        <div id="userpage">
					<p>
          	<img class='userimgpage' src='userImages/<?php echo $userData['id'].".".$userData["filetype"]; ?>' alt='<?php echo $userData['name']; ?>'/>
					</p>
          <h2>
            <?php echo $userData['name']; ?>
          </h2>
          <h3>
            <?php echo $userData['popularMemes']; ?> Popular Memes
          </h3>

          <div id="allMemes">
            <div ng-init="getMoreMemes('');sortMethod='new';"></div>
          </div>

        </div>

    <?php }}} ?>
    </div>
  </body>
</html>
