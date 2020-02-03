<form id="login" method="post" action="logIn.php">
	<table>
		<tr>
			<td><input name="name" placeholder="Username or Email" id="name" ng-model="loginName"/></td>
		</tr>
		<tr>
			<td><input name="pass" id="pass" placeholder = "Password" type="password" ng-model="loginPass"/></td>
		</tr>
		<tr ng-show="loginError" class="Error">
			<td>
				<span>Invalid username or password</span>
			</td>
		</tr>
		<tr>
			<td rowspan="2">
				<input type="button" id="submitLogin" ng-click='logIn(loginName,loginPass)' value="Log In" />
			</td>
		</tr>
	</table>
</form>
<form id="signUp" method="post" action="PHP/signUpHandler.php">
	<table>
			<tr>
				<td><p>Username</p></td>
			</tr>
			<tr>
				<td><input name="name" placeholder="Must be unique" id="namePass" ng-model="signupName"/></td>
			</tr>
					<tr>
						<td><p>Password</p></td>
					</tr>
			<tr>
				<td><input name="pass" id="signuppass" placeholder = "Must be 8+ characters" type="password" ng-model="signupPass"/></td>
			</tr>
			<tr>
				<td><input name="cpass" id="signupPassConf" placeholder = "Confirm Password" type="password"/></td>
			</tr>
			<tr>
				<td><p>Email</p></td>
			</tr>
			<tr>
				<td><input name="email" id="email" placeholder = "We won't sell it to scammers. Probably." type="text"/></td>
			</tr>
			<tr>
				<td><input name="getPromo" id="getPromo" type="checkbox"/><span>I would like notifications when people like my memes or buy my cookies</span></td>
			</tr>
				<td rowspan="2">
					<input type="submit" id="submitSignup" value="SIGN UP" />
				</td>
	</table>
</form>
