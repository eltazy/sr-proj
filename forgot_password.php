<?php
	include_once '_class/StudentManager.class.php';

	include '_pages/header.php'; ?>

<section class="main-container">
	<div class="main-wrapper">
<?php
	if(isset($_SESSION['repsyst_session_username'])) header("Location: index.php");
	if(isset($_GET['message'])){
		$message = $_GET['message'];
		switch ($message) {
			case 'success':
				echo '<label class="success_message">Check your email to change password</label><br/>';
				break;
			case 'nouser':
				echo '<label class="error_message">Email not matched to a user in database<br/></label>';
				break;
			case 'loggedin':
				echo '<label class="error_message">You are already logged in.<br/></label>';
				break;
		}
	}	
    if(isset($_POST['submit_pwd_forgotten'])){
		$email = $_POST['locked_user_email'];
		$temp_StudentManager = new StudentManager();
		$temp_user = $temp_StudentManager->get_from_email($email);
		if($temp_user){
			$headers = "From: support@ueab.ac.ke \r\n";
			$headers .= "Reply-To: no-reply@ueab.ac.ke \r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			$message = 'Reset your password <a href="http://localhost/sr-proj/reset_password.php?u="'.$temp_user->username().'>here</a>';
			mail($email, "Password Reset Link", $message, $headers);
			header("Location: forgot_password.php?message=success");
		}
		else header("Location: forgot_password.php?message=nouser");
    }
    else echo	'<form method="post" action="'.$_SERVER["PHP_SELF"].'">
				<input type="Email" name="locked_user_email" placeholder="Email@ueab.ac.ke"/>
				<button type="submit" name="submit_pwd_forgotten">Submit</button>
				</form>';
?>
	</div>
</section><?php exit() ?>