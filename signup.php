<?php
	if (!isset($_SESSION)) session_start();
	
	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';
	include_once '_class/AuthenticationManager.class.php';

	include '_pages/header.php';
	//if there is a running session go to home page
	if(isset($_SESSION['repsyst_session_username'])){
		header("Location: index.php");
		exit();
	}
	if(isset($_POST['submit_signup'])){
		$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$std_manager = new StudentManager($database);
	
		//creating student object and formatting attributes
		$t_array = array(
			'firstname'	=> ucfirst(strtolower($_POST['firstname'])),
			'middlename'=> ucfirst(strtolower($_POST['middlename'])),
			'lastname'	=> ucfirst(strtolower($_POST['lastname'])),
			'email'		=> strtolower($_POST['email']),
			'schoolid'	=> strtoupper($_POST['schoolid']));
		$temp_student = new Student($t_array);
	
		//setting username
		$t_username = explode('@', $t_array['email']);
		if($t_username[1] == 'ueab.ac.ke') $temp_student->setUsername($t_username[0]);
		else header("Location: signup.php?signup=wrongemail");
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
		if(isset($_POST['firstpasswd']) && isset($_POST['reenterpasswd'])){
			if($_POST['firstpasswd'] == $_POST['reenterpasswd']){
				global $database, $temp_student, $std_manager;
				$temp_Credentials = new Authentication($temp_student->username(), md5($_POST['firstpasswd']));
				$temp_CredManager = new AuthenticationManager($database);
				$uid = uniqid();
				$std_manager->temp_add($temp_student, $uid);
				$temp_CredManager->temp_add($temp_Credentials, $uid);
				$message = "Go to the following link to activate your account. http://localhost/sr-proj/validateAccount.php?usr=".$temp_student->username()."&uniqueid=".$uid;
				if(mail($temp_student->email(), 'Account Validation', $message)) header("Location: signup.php?signup=success");
				else header("Location: signup.php?signup=failed");
			}
			else header("Location: signup.php?signup=nomatch");
		}
		else header("Location: signup.php?signup=empty");
	}
	else{
		//handling signup messages
		if(isset($_GET['signup'])){
		   $signup = $_GET['signup'];
		   switch($signup){
			   case 'success':
			  	 echo '<label class="success_message">Account waiting for validation.<br/>
						Check your email to validate your account!</label><br/>';
				 break;
			   case 'failed':
				echo '<label class="error_message">Creating new user failed.<br/></label>';
				break;
			   case 'empty':
				echo '<label class="error_message">Fill both passwords.</label><br/>';
				break;
			   case 'invalidated':
			   	echo '<label class="error_message">Could not find account to validate.</label><br/>';	   
				break;
			   case 'nomatch':
				echo '<label class="error_message">Passwords do not match.</label><br/>';
				break;
			   case 'wrongemail':
				echo '<label class="error_message">Use a UEA Baraton e-mail address (<i>example@ueab.ac.ke</i>).</label><br/>';
				break;
		   }
		}
		unset($_GET['signup']);
		//checking type of user
		if(isset($_POST['type'])){
			include '_pages/signupform.php';
		}
		else{
			include '_pages/signupoptions.php';
		}
	}
?>