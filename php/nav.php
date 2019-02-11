
<?php
$rightSignUp=$email1=$email2=$password1=$password2=$captcha=$name=null;
	if (isset($_GET['createAccount']) && $_GET['createAccount']=="1") {
		?>
		<script>
			$(window).on('load',function() {
				$('#modalSignUpForm').modal('show');
			 });
		</script>
		<?php
	}

	if (!empty($_POST) && isset($_POST['search'])) {
		$_SESSION['search'] = $_POST['search'];
	}

	if (isset($_POST['emailLogIn']) && isset($_POST['passwordLogIn'])) {
		$userId = $_POST['emailLogIn'];
		$password = $_POST['passwordLogIn'];

		$rightLogIn = login($userId, $password);

		if ($rightLogIn==true) {
			header("Location: index.php");

		} else { //reload modalLogIn
			?>
			<script>
				$(window).on('load',function() {
			   		$('#modalLoginForm').modal('show');
				 });
		  	</script>
			<?php
		}
	}

	if (isset($_POST['fullNameSignUp']) && isset($_POST['emailSignUp'])
		&& isset($_POST['email2SignUp']) && isset($_POST['passwordSignUp'])
		&& isset($_POST['password2SignUp']) && isset($_POST['captcha'])) {

			$rightSignUp=true;
			$email1 = $_POST['emailSignUp'];
			$email2 = $_POST['email2SignUp'];
			$password1 = $_POST['passwordSignUp'];
			$password2 = $_POST['password2SignUp'];
			$captcha = strtoupper($_POST['captcha']);

			if ($email1 == $email2) {

				$name = $_POST['fullNameSignUp'];
				$userId = $email1;

			} else {
				$rightSignUp = false;
				$signUpError = "The emails do not match";
				exit();
			}

			if (!preg_match("/^\w+[@]\w+[.]\w+$/",$userId)) {
				$rightSignUp = false;
				$signUpError = "The email is not valid";
				exit();
			}

			 if ($password1 == $password2) {
				$password = $password1;

			} else {
				$rightSignUp = false;
				$signUpError = "The passwords do not match";
				exit();
			}

			if ($_SESSION['captcha']!=$captcha) {
				$rightSignUp = false;
				$signUpError = "The captcha is wrong";

			} else {
				echo "captcha no igual";
			}

			$role = 'user';

			if ($rightSignUp==true) {
				$favouritesPosts="";
				$user = new User($userId, $name, $password, $role, $favouritesPosts);

				if (signUp($user)) {
					login($user->userId, $user->password);
					header("Location: index.php");

				} else {
					$rightSignUp = false;
					$signUpError = "This email is already registered";
				}

			} else {
				?>
				<script>
					$(window).on('load',function() {
				   		$('#modalSignUpForm').modal('show');
					 });
			  	</script>
				<?php
			}
		}

	if (isset($_GET['exit']) && $_GET['exit']==true) {
		unset($_SESSION['user']);
		header("Location: /index.php");
	}
 ?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap Flat Modal Login Modal Form</title>
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">-->

	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
	<!--<script src="js/jquery-3.3.1.min.js"></script>-->
	<script src="styles/bootstrap/js/jquery.min.js"></script>
	<script src="styles/bootstrap/js/bootstrap.min.js"></script>

	<style>
		@import url("styles/modalFont.css");
		@import url("styles/bootstrap/css/bootstrap.min.css");
	    @import url('styles/modalLogin.css');
		@import url('styles/modalSignUp.css');
	</style>
</head>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!--<a class="navbar-brand" href="">Blog2</a>-->
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<?php
					if (isset($_SESSION['user']) && $_SESSION['user']['role']=="root") {
						?>
						<li><a href="/index.php">Home</a></li>
						<li><a href='/php/favouritePosts.php'>FavouritePosts</a></li>
						<li><a href="/php/listPosts.php">List Posts</a></li>
						<li><a href="/php/management.php">New Post</a></li>
						<?php

					} else if (isset($_SESSION['user']) && $_SESSION['user']['role']=="user") {
						?>
						<li><a href="/index.php">Home</a></li>
						<li><a href='/php/favouritePosts.php'>FavouritePosts</a></li>
						<li><a href="#">My comments</a></li>
						<?php

					} else if (!isset($_SESSION['user'])) {
						?>
						<li><a href="/index.php">Home</a></li>
						<?php
					}
				 ?>

			</ul>

			<ul class="nav navbar-nav navbar-right">

				<!-- Modal HTML -->
				<form name="logInForm" action="" method="post" onsubmit="return validateLogInForm();">
					<div id="modalLoginForm" class="modal fade">
						<div class="modal-dialog modal-login">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Login</h4>
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<form action="/examples/actions/confirmation.php" method="post">
										<div class="form-group">
											<?php if (isset($_POST['emailLogIn']) && $rightLogIn==false) echo "<span style='color: red;'> The email or password is wrong</span>"; ?>
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
												<input type="email" class="form-control" name="emailLogIn" placeholder="Email" required="required">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
												<input type="password" class="form-control" name="passwordLogIn" placeholder="Password" required="required">
											</div>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary btn-block btn-lg">Sign In</button>
										</div>
										<p class="hint-text"><a href="#">Forgot Password?</a></p>
									</form>
								</div>
								<div class="modal-footer">Don't have an account? <a href="index.php?createAccount=1">Create one</a></div>
							</div>
						</div>
					</div>
				</form>

				<form name="signUpForm" action="" onsubmit="return validateSignUpForm();" method="post">
					<div id="modalSignUpForm" class="modal fade">
						<div class="modal-dialog modal-login">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Sign Up</h4>
					                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<form action="/examples/actions/confirmation.php" method="post">
										<div class="form-group">
											<?php
												if (isset($rightSignUp)) {
													if (!$rightSignUp) echo "<span style='color: red;'> $signUpError</span>";
												}
											?>
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
												<input type="text" class="form-control" value="<?php if ($name!=null) echo $name; ?>" name="fullNameSignUp" placeholder="Full name" required="required">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
												<input type="email" value="<?php if ($email1!=null) echo $email1; ?>" class="form-control" name="emailSignUp" placeholder="Email" required="required">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
												<input type="email" value="<?php if ($email2!=null) echo $email2; ?>" class="form-control" name="email2SignUp" placeholder="Confirm email" required="required">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
												<input type="password" class="form-control" name="passwordSignUp" placeholder="Password" required="required">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
												<input type="password" class="form-control" name="password2SignUp" placeholder="Confirm password" required="required">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<img src="/captcha.php">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
												<input type="text" class="form-control" name="captcha" placeholder="Type the captcha" required="required">
											</div>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
										</div>
										<p class="hint-text"><a href="#">Forgot Password?</a></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</form>

				<?php
					if (!isset($_SESSION['user'])) {
						?>
						<form method='post' action='' class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input name="search" type="text" class="form-control" placeholder="Buscar">
								<button type="submit" class="btn btn-default">Enviar</button>
							</div>
						</form>

						<li><a href="#modalSignUpForm" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Sign Up</a></li>
						<li><a href="#modalLoginForm" data-toggle="modal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<?php
					} else {
						?>
						<form method='post' action='' class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input name="search" type="text" class="form-control" placeholder="Buscar">
								<button type="submit" class="btn btn-default">Enviar</button>
							</div>
						</form>

						<li>
							<a href="/index.php?exit=true" <span class="glyphicon glyphicon-log-out"></span> LogOut <?php echo $_SESSION['user']['name'];?></a>
						</li>




						</li>

						<?php
					}
				 ?>
			</ul>
		</div>
	</div>
</nav>

<!-- modal login-->
