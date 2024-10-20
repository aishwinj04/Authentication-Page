<?php 
	error_reporting(E_ALL);  // Report all errors, warnings, and notices
ini_set('display_errors', 1);  // Display errors on the screen
	
	include("includes/config.php");
	include("includes/classes/Constants.php");
	include("includes/classes/Account.php");
	$account = new Account($con);


	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name){
		if(isset($_POST[$name])){
			return $_POST[$name];
		}
	}
	
?>



<html>
<head>
	<title>Login or Sign Up!</title>
	<link rel="stylesheet" href="assets/css/register.css" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- jQuery Library -->
	<script src="assets/js/register.js"></script> <!-- Reference to js-->
	
	

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Permanent+Marker&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">


	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head> 
<body>

	<!-- Register button pressed output -->
	<?php
	if(isset($_POST['RegisterBtn'])){
		echo '<script>
			$(document).ready(function(){
				$("#loginForm").hide();
				$("#registerForm").show();
			});
		</script>';

	// Login Button pressed output  
	}else{
		echo '<script>
			$(document).ready(function(){
				$("#loginForm").show();
				$("#registerForm").hide();
			});
		</script>';
	}
	?>


	<div id="background">

		<div id="box">
			

			<div id="loginContainer">

				<div id="inputContainer">
					

					<!-- First form for login  --> 
					<form id="loginForm" action="register.php" method="POST">
						<h2>Login to your account</h2>

					 <!-- p elements strictly for visualization --> 

						<p>
							<?php echo $account->getError(Constants::$loginFailed); ?>
							<label for="loginUsername">Username</label>
							<input id="loginUsername" name="loginUsername" type="text" placeholder="username" value="<?php echo getInputValue('loginUsername'); ?>" required>
						</p>
						
						<p>
							<label for="loginPassword">Password</label>
							<input id="loginPassword" name="loginPassword" type="password" placeholder="password" required>
						</p>

						<button type="submit" name="LoginBtn">LOGIN</button>

						<div class="hasAccountText">
							<span id="hideLogin">New to Spotify? Sign Up</span>


						</div>
						
					</form>


				    <!-- Second form for register  -->
					<form id="registerForm" action="register.php" method="POST">
						<h2>Create your free account</h2>
						<p>

							<?php  echo $account->getError(Constants::$usernameLength); ?>
							<?php echo $account->getError(Constants::$usernameTaken); ?>
							<label for="registerUsername">Username</label>
							<input id="registerUsername" name="registerUsername" type="text" placeholder="janedoe91" value="<?php echo getInputValue('registerUsername'); ?>" required>
						</p>

						<p>
							<?php  echo $account->getError(Constants::$firstNameLength); ?>
							<?php  echo $account->getError(Constants::$firstNameLetters); ?>
							<label for="firstName">First name</label>
							<input id="firstName" name="firstName" type="text" placeholder="Jane" value="<?php echo getInputValue('firstName'); ?>" required>
						</p>

						<p>
							<?php  echo $account->getError(Constants::$lastNameLength); ?>
							<?php  echo $account->getError(Constants::$lastNameLetters); ?>
							<label for="lastName">Last name</label>
							<input id="lastName" name="lastName" type="text" placeholder="Doe" value="<?php echo getInputValue('lastName'); ?>" required>
						</p>

						<p>
							<?php  echo $account->getError(Constants::$emailNotMatch); ?>
							<?php  echo $account->getError(Constants::$emailInvalid); ?>
							<?php echo $account->getError(Constants::$emailTaken); ?>
							<label for="email">Email</label>
							<input id="email" name="email" type="email" placeholder="example@gmail.com" value="<?php echo getInputValue('email'); ?>" required>
						</p>

						<p>

							<label for="email2">Confirm email</label>
							<input id="email2" name="email2" type="email" placeholder="example@gmail.com" value="<?php echo getInputValue('email2'); ?>" required>
						</p>

						<p>
							<?php  echo $account->getError(Constants::$passwordsNotMatch); ?>
							<?php  echo $account->getError(Constants::$passwordsLength); ?>
							<label for="registerPassword">Password</label>
							<input id="registerPassword" name="registerPassword" type="password" placeholder="Your password"  required>
						</p>

						<p>
							<label for="registerPassword2">Confirm password</label>
							<input id="registerPassword2" name="registerPassword2" type="password" placeholder="Your password" required>
						</p>

						<button type="submit" name="RegisterBtn">SIGN UP</button>

						<div class="hasAccountText">
							<span id="hideSignUp">Have an Account? Login</span>
						</div>
						
					</form>


				</div>

				<div id="loginText">
					<h1>Welcome to the Platform</h1>
					<h2>Your Journey Begins Here!</h2>
					<ul>
						<li>Personalize Your Dashboard</li>
						<li>Stay Updated with New Features</li>
						<li>Discover Your Favorites</li>
					</ul>


				</div>




			</div>
			

			


		</div>

	</div>


</body>
</html>