<div>
<p class="mobileNav"
	<?php
	///View for users who have not yet logged in
	///Nate Roskelley September 2020

		if(!isset($_GET["sort"])&&strpos($_SERVER['REQUEST_URI'],"index.php")!=false){
			echo "style='background-color:var(--head-nav-bg-color-2);'";
		} ?>
		>

		<a href="index.php">Home</a>
		</p>
		<!--If the user is on mobile, store everything on the sidebar-->
		<p class="mobileNav"
		<?php
			if(strpos(isset($_GET["sort"])&&$_SERVER['REQUEST_URI'],"index.php")!=false){
				echo "style='background-color:var(--head-nav-bg-color-2);'";
			} ?>
			>
			<a href="seeCookies.php?sort=new">Cookies</a>
	</p>
	<p id="mobileJar" class="mobileNav">
		<a href='https://merchies-shop.com/cart'>Cart</a>
	</p>
</div>
<!--Log the user in-->
<form id="login" method="post" action="PHP/logIn.php">
	<table>
		<tr>
			<td><input name="name" placeholder="Username or Email" id="name" ng-model="loginName"/></td>
		</tr>
		<tr>
			<td><input name="password" id="pass" placeholder = "Password" type="password" ng-model="loginPass"/></td>
		</tr>
		<tr ng-show="loginError" class="Error">
			<td>
				<span>Invalid username or password</span>
			</td>
		</tr>
		<tr>
			<td rowspan="2">
				<input type="submit" id="submitLogin" value="Log In" />
			</td>
		</tr>
	</table>
</form>



<!-- Sign the user up -->

<form name="signUp" id="signUp" method="post" action="PHP/registerHandler.php" novalidate>
	<table>
			<tr>
				<td><p>Username</p></td>
			</tr>
			<tr>
				<td><input name="name" placeholder="Must be unique" id="namePass" ng-model="signupName" ng-blur="checkName();" /></td>
			</tr>
			<tr ng-hide="nameExists">
				<td class="error">Sorry, that name is taken.</td>
			</tr>
			<tr>
				<td><p>Password</p></td>
			</tr>
			<tr>
				<td><input name="pass" id="signuppass" placeholder = "Must be 8+ characters" type="password" ng-model="signuppass" ng-minlength="8" required /></td>
			</tr>
			<tr>
				<td><input name="cpass" id="signupPassConf" placeholder = "Confirm Password" type="password" ng-model = "signupPassConf"  /></td>
			</tr>
			<tr ng-show="signUp.pass.$invalid && signUp.pass.$touched">
				<td class="error">
					Your password must be 8 or more characters
				</td>
			</tr>
			<tr ng-show="signuppass!=signupPassConf && signUp.cpass.$touched">
				<td class="error">
					Passwords must match
				</td>
			</tr>
			<tr>
				<td><p>Email</p></td>
			</tr>
			<tr>
				<td><input name="email" id="email" placeholder = "We won't sell it to scammers. Probably." type="email" ng-model='signupEmail' required /></td>
			</tr>
			<tr ng-show="signUp.email.$invalid && signUp.email.$touched">
				<td class="error">
					Invalid Email Address
				</td>
			</tr>
			<tr>
				<td>
					<label class="checkmarkContainer">I agree to the <a href="terms-and-conditions.php" target="_blank">terms and conditions</a>
					  <input type="checkbox" ng-model="termsandagreements" id="termsandagreements" name="termsandagreements" />
					  <span class="checkmark"></span>
					</label>
					</td>
			</tr>
				<td rowspan="2">
					<input type="submit" id="submitSignup" value="SIGN UP" ng-disabled="(!signUp.name.$valid || !signUp.pass.$valid  || signuppass!=signupPassConf || !termsandagreements || signUp.email.$invalid )" />
				</td>
	</table>
</form>
