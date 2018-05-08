<?php
    if (!isset($_SESSION)) session_start();

	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';
	include_once '_class/AuthenticationManager.class.php';

    include_once './_config/db.php';
	
	if(isset($_SESSION['repsyst_session_username'])) header("Location: index.php");
?>
<head>
<meta charset="utf-8" />
    <link rel="shortcut icon" href="_css_images/ueab_icon.ico" />
	<title>Login</title>
	<!-- TODO:(7) (CSS) Change styling -->
	<link rel="stylesheet" type="text/css" href="style.php">

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
	<body id="login-body">
	<div class="col-md-12 col-lg-12" id="loginForm">
		<!-- <div class=""> -->
			<h1>Login</h1>
	<?php
				if(isset($_POST['submit_login'])){
					unset($_GET['login']);
					$user_input_username = $_POST['username'];
					$user_input_password = $_POST['password'];

					if(empty($user_input_username) || empty($user_input_password)) header("Location: login.php?login=empty");
					else{ //if none of the fields is empty login retrieve db credentials
						$database = new PDO($dbconnexion, $dbuser, $dbpwd);
						$user_input_cred = new Authentication($user_input_username, md5($user_input_password));
						$temp_CredManager = new AuthenticationManager($database);
						$temp_db_cred = $temp_CredManager->get($user_input_username);
						$Manager = ($temp_db_cred->type() == 'S' ? 'Student' : 'Lecturer').'Manager';
						$temp_user_manager = new $Manager($database);

						if($user_input_cred->matches($temp_db_cred)){ //if there is a match in the db
							$temp_session_user = $temp_user_manager->get($user_input_username);
							$_SESSION['repsyst_session_fullname'] = $temp_session_user->fullname();
							$_SESSION['repsyst_session_username'] = $temp_session_user->username();
							$_SESSION['repsyst_session_firstname'] = $temp_session_user->firstname();
							$_SESSION['repsyst_session_middlename'] = $temp_session_user->middlename();
							$_SESSION['repsyst_session_lastname'] = $temp_session_user->lastname();
							$_SESSION['repsyst_session_gender'] = $temp_session_user->gender();
							$_SESSION['repsyst_session_type'] = $temp_session_user->type();
							$_SESSION['repsyst_session_email'] = $temp_session_user->email();
							$_SESSION['repsyst_session_projects'] = $temp_session_user->projects();
							$_SESSION['repsyst_session_ideas'] = $temp_session_user->ideas();
							if(strtolower($temp_session_user->username())=='admin') 
								header("Location: admin/index.php");
							else header("Location: profile.php?myprofile");
						}
						else header("Location: login.php?login=nomatch"); //there is no match in the db
					}
				}
				else{ //if the user didnt click on the submit button
					
					//show login form
					?>
					<div class="container"><?php
					//handling login error messages
					if(isset($_GET['login'])){
						echo '<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">';
						$login = $_GET['login'];
						switch ($login) {
							case 'pwd_changed':
								echo '<div class="alert alert-success">Password successfully changed! Login now.</div><br/>';
								break;
							case 'error':
								echo '<div class="alert alert-danger">Log in error!</div><br/>';
								break;
							case 'empty':
								echo '<div class="alert alert-danger">Fill both Username and Password</div><br/>';
								break;
							case 'nomatch':
								echo '<div class="alert alert-danger">Username or password incorrect</div><br/>';
								break;
							case 'validated':
								echo '<div class="alert alert-success">Account validated. Login now</div><br/>';
								break;
						}
						echo '</div>';
						unset($_GET['login']);
					}?>
						<form class="form-signin" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">
							<!-- <h2 class="form-signin-heading">Please sign in</h2> -->
							<div class="row">
							<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
								<input class="form-control" type="text" name="username" placeholder="Username" required="" autofocus=""/><br>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
								<input class="form-control" type="Password" name="password" placeholder="Password" required=""/><br>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-offset-4 col-xs-4 col-md-offset-5 col-md-2 col-lg-offset-5 col-lg-2">
								<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_login">Signin</button>
							</div>
							</div>
						</form></div>
						<div class="row">
							<b><a style="color: black;" href="signup.php">Sign up</a></b>
						</div>
						<div class="row">
							<b><a style="color: black;" href="forgot_password.php">Forgot password?</a></b>
						</div>
				<!-- </div> -->
				</div>';
				<?php } ?>
</body><?php exit() ?>