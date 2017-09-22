<?php
	if(!isset($_SESSION)) session_start();

	include_once 'StudentManager.class.php';
	include_once 'LecturerManager.class.php';
	include_once 'AuthenticationManager.class.php';?>

	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Signing up</title>
	</head>
<?php
	$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
	$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$std_manager = new StudentManager($database);

	//creating student object
	$t_array = array(
		'firstname'	=> ucfirst(strtolower($_POST['firstname'])),
		'middlename'=> ucfirst(strtolower($_POST['middlename'])),
		'lastname'	=> ucfirst(strtolower($_POST['lastname'])),
		'email'		=> strtolower($_POST['email']),
		'schoolid'	=> strtoupper($_POST['schoolid']));
	$temp_student = new Student($t_array);

	//setting username
	$t_username = explode('@', $t_array['email']);
	$temp_student->setUsername($t_username[0]);

	//setting major
	switch ($_POST['major']){
	 	case 'SWEN':
	 	$temp_student->setMajor(Major::SWEN);
	 		break;
	 	case 'NETW':
	 	$temp_student->setMajor(Major::NETW);
	 		break;
	 	case 'BBIT':
	 	$temp_student->setMajor(Major::BBIT);
	 		break;
	}
	//setting gender
	switch ($_POST['gender']){
	 	case 'Male':
	 	$temp_student->setGender(Gender::MALE);
	 		break;
	 	case 'Female':
	 	$temp_student->setGender(Gender::FEMALE);
	 		break;
	}

	//adding credentials to database
	if(isset($_POST['firstpasswd']) == isset($_POST['reenterpasswd'])){
		if($_POST['firstpasswd'] == $_POST['reenterpasswd']){
			global $database, $temp_student, $std_manager;
			$temp_Credentials = new Authentication($temp_student->username(), md5($_POST['firstpasswd']));
			$temp_CredManager = new AuthenticationManager($database);
			$uid = uniqid();
			$std_manager->temp_add($temp_student, $uid);
			$temp_CredManager->temp_add($temp_Credentials, $uid);
			$message = "Go to the following link to activate your account. http://localhost/project/validateAccount.php?usr=".$temp_student->username()."&uid=".$uid;
			if(mail($temp_student->email(), 'Account Validation', $message)){
				echo "<label class=\"success_message\">Account waiting for validation.<br/>Check your email to validate your account!<br/></label>";
			}
			else{
				echo "<label class=\"error_message\">Creating new user failed.<br/></label>";
				include("signup.php");
			}
		}
		else{
			echo "<label class=\"error_message\">Passwords don't match<br/></label>";
			include("signup.php");
		}
	}
	else include("signup.php");
	?>