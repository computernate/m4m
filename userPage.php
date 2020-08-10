<?php
	session_start();
?>
<html ng-app="money4memes">
	<head>
		<title>User</title>
		<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
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
          	<img class='userimgpage' src='userImages/<?php echo $userData['id'].".".$userData["fileType"]; ?>' alt='<?php echo $userData['name']; ?>'/>
					</p>
          <h1>
            <?php echo $userData['name']; ?>
          </h1>

          <div id="allMemes">
            <div ng-init="sortMethod='new';getMoreMemes('&madeBy=<?php echo $userData['id']; ?>');"></div>
          </div>

        </div>

    <?php }}} ?>
    </div>
  </body>
</html>
