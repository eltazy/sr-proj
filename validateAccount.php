<?php
	include_once 'StudentManager.class.php';
	include_once 'LecturerManager.class.php';
	include_once 'AuthenticationManager.class.php';?>

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Validate Account</title>
	</head>
<?php

	$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
	$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$usr = $_GET['usr'];
	$uid = $_GET['uid'];
	//creating student object
	$std_manager = new StudentManager($database);
	$new_student = $std_manager->temp_get($usr, $uid);
	//creating authentication object
	$cred_manager = new AuthenticationManager($database);
	$new_credentials = $cred_manager->temp_get($usr, $uid);
	//adding certified student and credentials to database
	$std_manager->add($new_student);
	$cred_manager->add($new_credentials);
	//removing temporary student profile and credentials to temporary database
	$std_manager->temp_delete($new_student, $uid);
	$cred_manager->temp_delete($new_credentials, $uid);
	echo "<label class=\"success_message\">Account validated.<br/><br/></label>";
?>
	<a href="login.php">Login now!</a>