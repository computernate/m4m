<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Report Copy</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
      <?php
        if(!isset($_GET['copyid'])||!isset($_GET['copytype'])){
          echo '<h2>Sorry, we couldn\'t find the meme you asked for. Please try again!</h2>';
        }
        else{
      ?>
      <form method="post" action="PHP/reportCopyHandler.php">
        <input type="hidden" name='meme1' value = "<?php echo $_GET["copyid"]; ?>"/>
        <table id='reportCopy' id="copy">
          <tr>
            <td colspan = "2">
              <h2>
                Thanks for catching this repost! Here is how to report it:
              </h2>
                <p>Open a new tab and go to www.the-memery.com</p>
                <p>Use the search bar to find the old meme</p>
                <p>Copy the meme's id (everything after ?memes=) into the 2nd feild</p>
                <p>After you submit, we will review your submission and determine if it is a repost.</p>
                <p>If it is, any likes not shared will be given to the origional poster, and we will delete the old one.</p>
            </td>
          </tr>
          <tr>
            <td>
              <p><img src = "Memes/<?php echo $_GET["copyid"].".".$_GET['copytype'] ?>" /></p>
            </td>
            <td>
              <p><input type = 'text' ng-model = 'copyMeme' placeholder = "Meme Id" name = 'copyMeme' /></p>
              <p><img ng-src = "Memes/{{copyMeme}}" alt = "Select a meme"/></p>
            </td>
          </tr>
          <tr>
            <td colspan = "2">
              <input type="submit" value = "Submit Copy" />
            </td>
          </tr>
        </table>
      </form>
      <?php
      }
      ?>
    </div>
  </body>
</html>
