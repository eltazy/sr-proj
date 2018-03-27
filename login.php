<?php
    if (!isset($_SESSION)) session_start();

	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';
	include_once '_class/AuthenticationManager.class.php';

	include '_pages/header.php';
	
	if(isset($_SESSION['repsyst_session_username'])){
		header("Location: index.php");
		exit();
	}
?>
<head>
	<meta charset="utf-8" />
	<!-- TODO:(7) (CSS) Change styling in style.css then uncomment next line-->
	<link rel="stylesheet" href="style.css" 
	<title>Login</title>
</head>

<section class="main-container">
	<div class="main-wrapper">
		<h1 style="margin-right: 30%;">Login</h1>
<?php
			if(isset($_POST['submit_login'])){
				unset($_GET['login']);
				$user_input_username = $_POST['username'];
				$user_input_password = $_POST['password'];

				if(empty($user_input_username) || empty($user_input_password)) header("Location: login.php?login=empty");
				else{ //if none of the fields is empty login retrieve db credentials
					$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
					$user_input_cred = new Authentication($user_input_username, md5($user_input_password));
					$temp_CredManager = new AuthenticationManager($database);
					$temp_StudentManager = new StudentManager($database);
					$temp_db_cred = $temp_CredManager->get($user_input_username);

					if($user_input_cred == $temp_db_cred){ //if there is a match in the db
						$temp_session_user = $temp_StudentManager->get($user_input_username);
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
						header("Location: profile.php?myprofile");
						exit();
					}
					else header("Location: login.php?login=nomatch"); //there is no match in the db
				}
			}
			else{ //if the user didnt click on the submit button
				 
				//handling login error messages
				 if(isset($_GET['login'])){
					$login = $_GET['login'];
					switch ($login) {
						case 'pwd_changed':
							echo '<label class="success_message">Password successfully changed! Login now.</label><br/>';
							break;
						case 'error':
							echo '<label class="error_message">Log in error!</label><br/>';
							break;
						case 'empty':
							echo '<label class="error_message">Fill both Username and Password</label><br/>';
							break;
						case 'nomatch':
							echo '<label class="error_message">Username or password incorrect</label><br/>';
							break;
						case 'validated':
							echo '<label class="success_message">Account validated. Login now</label><br/>';
							break;
					}
				}
				//show login form

				echo	'		



				<form class="login-form" method="post" style="margin: 1% 10%;height: 215px;"action="'.$_SERVER["PHP_SELF"].'">

				<div class="container-input">
									<input type="text" name="username" placeholder="Username"/><br/>
									<input type="Password" name="password" placeholder="Password"/><br/>
									<button type="submit" name="submit_login" style="margin: 40px auto;">Log In</button>
									</div>
								</form>
								<div class="login-support">
								<a class="sign-up" href="signup.php">Sign up</a>
								<a class="forgot" href="forgot_password.php">Forgotten Password?</a>
								</div>
							</div>
						</section>';
			}
//end of script: EOScript
?>