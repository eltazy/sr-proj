<?php
	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';
	include_once '_class/AuthenticationManager.class.php';

	include '_pages/header.php';

	if(isset($_GET['usr']) && isset($_GET['uniqueid'])){
		$database = new PDO($dbconnexion, $dbuser, $dbpwd);
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$usr = $_GET['usr'];
		$uid = $_GET['uniqueid'];
		$std_manager = new StudentManager($database);
		$cred_manager = new AuthenticationManager($database);

		if($std_manager->tempStudentExists($usr, $uid) && $cred_manager->tempCredentialsExists($usr, $uid)){
			//creating new student and credentials
			$new_student = $std_manager->temp_get($usr, $uid);
			$new_credentials = $cred_manager->temp_get($usr, $uid);
			//adding certified student and credentials to database
			$std_manager->add($new_student);
			$cred_manager->add($new_credentials);
			//removing temporary student profile and credentials to temporary database
			$std_manager->temp_delete($new_student, $uid);
			$cred_manager->temp_delete($new_credentials, $uid);
			header("Location: login.php?login=validated");
		}
		else header("Location: signup.php?signup=invalidated");
	}
	exit();
?>