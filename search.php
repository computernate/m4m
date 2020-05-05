<?php
	session_start();
?>
<html ng-app="money4memes">
	<head>
		<title>Search</title>
	<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">

      <div id="searchQuery" class='genericBlock'>
	     <h2>
				<form name="search" method="get" action="search.php">
	          <?php
	            if(isset($_GET["search"])){
	              echo "SEARCH RESULTS FOR: <input type='text' id='search' name='search' value='".$_GET["search"]."' />";
	            }
	            else{
	              echo "NO SEARCH FOUND. PLEASE TRY AGAIN</h2>";
	                echo "<h2>But only if you want I guess. I'm a computer, not your mom";
	            }
	          ?>
					</form>
        </h2>
      </div>

      <div id="allMemes">
				<div ng-init="getMoreMemes('&search=<?php echo $_GET['search'] ?>')"></div>
			</div>
    </div>
    <h4>
      End of search results. If you haven't found what you're looking for, maybe that's an opportunity to make it.
    </h4>
  </body>
</html>
