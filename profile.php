<?php
	if(!isset($_SESSION)) session_start();
	
	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';

	include '_pages/header.php';?>
<body>
	<div class="container-fluid">
	<?php

	if(isset($_GET['change'])){
		$message = $_GET['change'];
		switch ($message){
			case 'changepwdsuccess':
				echo '<div class="row"><label class="success_message"> Your password was changed successfully</label></div>';		
				break;
		}
		unset($_GET['change']);
	}

	if(isset($_GET['user'])){
		$username = $_GET['user'];
		$temp = isset($_SESSION['repsyst_session_username'])?$_SESSION['repsyst_session_username']:'';
		// current logged user
		if ($username == 'myprofile' || $username == $temp){
						// <img class="img-profile" src="'.$_SESSION['repsyst_session_profilepic'].'"></br>
			echo	'<head><title>My Profile</title></head>
					<div class="col-md-offset-2 col-md-6">
					<form action="edit_profile.php" method="POST">
						<div class="row"><label>Firstname:</label> '.$_SESSION['repsyst_session_firstname'].'</div>
						<div class="row"><label>Middlename:</label> '.$_SESSION['repsyst_session_middlename'].'</div>
						<div class="row"><label>Lastname:</label> '.$_SESSION['repsyst_session_lastname'].'</div>
						<div class="row"><label>Username:</label> '.$_SESSION['repsyst_session_username'].'</div>
						<div class="row"><label>E-mail:</label> '.$_SESSION['repsyst_session_email'].'</div>
						<div class="row"><button class="btn btn-default" type="submit" name="submit_edit_profile">Edit Profile</button></div>
					</form>
					<form action="change_password.php" method="POST">
						<button class="btn btn-default" type="submit" name="submit_change_password">Change Password</button>
					</form></div>';
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
			echo	'<form>
						<img class="img-profile" src="<?= $user_pic ?>"></br>
						Firstname: <label><?= $user->firstname() ?></label></br>
						Middlename:<label><?= $user->middlename() ?></label></br>
						Lastname:<label><?= $user->lastname() ?></label></br>
						User handle:<label>@'.$user->username().'</label></br>
						Projects:<label>['.$user->projects().']</label></br>
					</form>';
		}
	}
	else header("Location: index.php");
?>
	</div>
</body>