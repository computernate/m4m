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
<form name="signUp" id="signUp" method="post" action="PHP/signUpHandler.php" novalidate>
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
				<td><input name="cpass" id="signupPassConf" placeholder = "Confirm Password" type="password" ng-model = "signupPassConf"/></td>
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
				<td><input name="email" id="email" placeholder = "We won't sell it to scammers. Probably." type="email" required /></td>
			</tr>
			<tr ng-show="signUp.email.$invalid && signUp.email.$touched">
				<td class="error">
					Invalid Email Address
				</td>
			</tr>
			<tr>
				<td><input name="getPromo" id="getPromo" type="checkbox"/><span>I would like notifications when people like my memes or buy my cookies</span></td>
			</tr>
				<td rowspan="2">
					<input type="submit" id="submitSignup" value="SIGN UP" ng-disabled="(!signUp.name.$valid || !signUp.pass.$valid || signUp.email.$invalid)" />
				</td>
	</table>
</form>
