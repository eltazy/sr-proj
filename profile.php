<?php
	if(!isset($_SESSION)) session_start();
	
	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';
	include_once '_class/AuthenticationManager.class.php';

	include '_pages/header.php';

	$user = $_GET['user'];
	if ($user == 'myprofile' || $user == $_SESSION['repsyst_session_username']) echo '<head><title>My Profile</title></head>';
	else echo '<head><title>'.$user.'\'s Profile</title></head>';

	if(isset($_GET['change'])){
		$message = $_GET['change'];
		switch ($message){
			case 'changepwdsuccess':
				echo '<label class="success_message"> Your password was changed successfully</label></br>';		
				break;
		}
		unset($_GET['change']);
	}
	if(isset($_GET['user'])){
		if ($user == 'myprofile' || $user == $_SESSION['repsyst_session_username']) include '_pages/myprofile.php';
		else{
			$user_pic = '';
			global $user_firstname,$user_middlename,$user_lastname,$user_username;
			if (file_exists('./_uploads/_profiles/profile_'.$user_username)) $user_pic = '_uploads/_profiles/profile_'.$sess_username;
			else{
				if($sess_user_gender == 'male') $user_pic = '_uploads/_profiles/male_default.jpg';
				else $user_pic = '_uploads/_profiles/female_default.jpg';
			}
		}
	}
	else header("Location: index.php");
?>