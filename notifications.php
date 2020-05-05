<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Notifications</title>
	<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
      <div class="genericBlock">
				<?php
					$user=$_SESSION["ID"];
					$sql = "SELECT notification FROM notifications WHERE user = '$user' SORT BY date";

					$result = $conn->query($sql);

					if($result->num_rows > 0) {
						$returnString="";
						while($row=mysqli_fetch_array($result)){
							echo "<p>".$row["notification"]."</p>";
						}
					}
					else{
						echo "You have no notifications. When you sell cookies, ";
					}
				 ?>
			</div>
    </div>
  </body>
</html>
