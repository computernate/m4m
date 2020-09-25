<?php
///Change the user's banking info
///Nate Roskelley September 2020
	session_start();
?>

<html ng-app="merchies">
	<head>
		<title>Earnigns Info</title>
	<link rel='icon' href='favicon.ico' type='image/x-icon'/ >
	</head>
	<body ng-controller="merchiesctrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
      <form action="PHP/changeEarnings.php" method="post" id="changeEarnings" class="genericBlock" name="changeEarnings" novalidate>
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
				<br />
				<p>You will receive <span>$1.00</span> for each of your <span>large</span> and <span>party</span> cookies sold, and <span>$0.50</span> for each normal. That can add up very fast if you advertise well for it!</p>
				<p>Payments for each month begin going out on the <span>15th</span> of the following month.</p>
			<br />
        <p ng-bind="earningsMethodText"></p>
				<input ng-show="earningsSelected" type="text" name="earningsID" id="earningsID" ng-model="earningsID" required validate-payment/>
				<input type="submit" ng-show="earningsSelected" ng-disabled="(!changeEarnings.earningsID.$valid)" />
      </form>
    </div>
  </body>
</html>
