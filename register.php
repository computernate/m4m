<?php
	session_start();
?>


<html ng-app="money4memes">
	<head>
		<title>Memes</title>
	</head>
	<body ng-controller="memectrl">
		<?php include "PHP/head.php" ?>
		<div id="wrapper">
			<form 
			action='PHP/registerHandler.php' 
			name="signUp" 
			method='post' 
			class="generalBox" 
			id="signUp" 
			novalidate >
		
		<h1>Welcome to Dank Dollarz!</h1>
		
		<p>Now, you can make money by making memes! Each meme is a T shirt as well, which you can sell using our platform</p>
		<p>Dank Dollarz is currently in Beta, and is very new. If you find any errors or have ideas, please contact me at nateroskelley@gmail.com</p>
		
		<table>
		
		
			<tr>
				<td><label>Name</label></td>
				<td><input 
					type='text' 
					name="name" 
					ng-blur="checkName();" 
					ng-model="signUpName" 
					required />
				</td>
			</tr>
			
			<tr ng-hide="nameExists">
				<td colspan="2" class="error">Sorry, that name is taken.</td>
			</tr>
			
			
			<tr>
				<td><label>Password</label></td>
				<td><input 
					type='password' 
					name="password" 
					ng-model="signUpPassword" 
					ng-minlength="6" 
					required />
				</td>
			</tr>
			
			<tr ng-show="signUp.password.$invalid && signUp.password.$touched">
				<td colspan="2" class="error">
					Your password must be 6 or more characters
				</td>
			</tr>
			
			
			<tr>
				<td><label>Email</label></td>
				<td><input 
					type='email' 
					name="email" 
					ng-model="signUpEmail" 
					required />
				</td>
			</tr>

			<tr ng-show="signUp.email.$invalid && signUp.email.$touched">
				<td colspan="2" class="error">
					Invalid Email Address
				</td>
			</tr>
			
			
			<tr>
				<td><label>Subscribe to email list</label></td>
				<td><input type='checkbox' name="emailList" value="yes" /></td>
			</tr>
			
			
			<tr>
				<td colspan="2">
					<input 
						type="submit"
						ng-disabled="(!signUp.name.$valid || !signUp.password.$valid || !signUp.email.$valid)" />
				</td>
			</tr>
		</table>
		
		<!--Set by checkName() when onblur is activated for name-->
		<input name="key" id="key" type="hidden" />
		</form>
		</div>
	</body>
</html>