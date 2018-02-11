<?php
	if(!isset($_SESSION)) session_start();
	
	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';

	include '_pages/header.php';

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
		$username = $_GET['user'];
		$temp = isset($_SESSION['repsyst_session_username'])?$_SESSION['repsyst_session_username']:'';
		// current logged user
		if ($username == 'myprofile' || $username == $temp){
			echo '<head><title>My Profile</title></head>';
			include '_pages/myprofile.php';
		}
		// another user's profile
		else{
			
			$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$__Manager = $_GET['type'].'Manager';
			$manager = new $__Manager($database);
			// getting user info
			$user = $manager->getPublicInfo($username);
			// customizing page title eg. "Michel's Profile"
			echo '<head><title>'.$user->firstname().'\'s Profile</title></head>';
			// setting user pic path
			$user_pic = '';
			if (file_exists('./_uploads/_profiles/profile_'.$user->username()))
				$user_pic = '_uploads/_profiles/profile_'.$sess->username();
			else{
				if($user->gender() == Gender::MALE) $user_pic = '_uploads/_default/male_default.jpg';
				else $user_pic = '_uploads/_default/female_default.jpg';
			}
			// showing details
			include '_pages/userprofile.php';
		}
	}
	else header("Location: index.php");
?>