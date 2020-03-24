<?php
	session_start();
?>

<html ng-app="money4memes">
	<head>
		<title>Add meme</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
      <form action="PHP/changeEarnings.php" method="post" id="changeEarnings" name="changeEarnings" novalidate>
				<p>
					<label for="paypal" ng-click='changeEarningsText("paypal")'>
	        	<input type="radio" id="paypal" value="paypal" name="earningsMethod" />
	          Paypal
					</label>
					<label for="venmo" ng-click='changeEarningsText("venmo")'>
	        	<input type="radio" id="venmo" value="venmo" name="earningsMethod" />
	          Venmo
					</label>
					<label for="googlePay" ng-click='changeEarningsText("googlePay")'>
	        	<input type="radio" id="googlePay" value="googlePay" name="earningsMethod" />
	          Google Pay
					</label>
				</p>
				<p>You will receive $0.75 for each of your cookies sold. That can add up very fast if you advertise well for it!</p>
				<p>Payments for each month begin going out on the 15th of the next month.</p>
        <p ng-bind="earningsMethodText"></p>
				<input ng-show="earningsSelected" type="text" name="earningsID" id="earningsID" ng-model="earningsID" required validate-payment/>
				<input type="submit" ng-show="earningsSelected" ng-disabled="(!changeEarnings.earningsID.$valid)" />
      </form>
    </div>
  </body>
</html>
