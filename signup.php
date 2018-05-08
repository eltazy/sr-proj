<?php
	if (!isset($_SESSION)) session_start();
	
	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';
	include_once '_class/AuthenticationManager.class.php';
	include '_pages/header.php';
?>
<head>
	<title>Sign Up!</title>
    <script src="_scripts/jquery-3.3.1.min.js"></script>
	<script src="_scripts/signup.js"></script>
</head>
<body>
<!-- <body style="background-color: rgb(58, 161, 245);"> -->
<div class="container-fluid" id="pagecontent">
<?php

	if(isset($_SESSION['repsyst_session_username'])) header("Location: index.php");
	if(isset($_POST['submit_signup'])){
		$database = new PDO($dbconnexion, $dbuser, $dbpwd);
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
				$message = "Go to the following link to activate your account. http://localhost/sr-proj/validateaccount.php?usr=".$temp_student->username()."&uniqueid=".$uid;
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
		?>
		
		<div class="col-md-12 col-lg-12" id="signupForm">
		<h1>Signup</h1>
		<form class="form-signin" method="post" action="<?= $_SERVER["PHP_SELF"] ?>">					
			<!-- firstname -->
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
					<input class="form-control" type="text" name="firstname" required placeholder="First Name" value="<?php if(isset($_POST['firstname'])) $_POST['firstname'];?>" /><br/>
				</div>
			</div>
			<!-- middlename -->
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
					<input class="form-control" type="text" name="middlename" placeholder= "Middle Name" value="<?php if(isset($_POST['middlename'])) $_POST['middlename'];?>" /><br/>
				</div>
			</div>
			<!-- lastname -->
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
					<input class="form-control" type="text" name="lastname" required placeholder="Last Name" value="<?php if(isset($_POST['lastname'])) $_POST['lastname'];?>" /><br/>
				</div>
			</div>
			<!-- gender -->
			<div class="row">
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
						<select class="form-control" name="gender" required placeholder="Last Name">
							<option value="Select" disabled selected hidden>Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select><br/>
					</div>
				</div>
			</div>
			<!-- major -->
			<div class="row">
				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
							<select class="form-control" name="major" required>
								<option value="Select" disabled selected hidden>Major</option>
								<option value="SWEN">Software Engineering</option>
								<option value="NETW">Networking</option>
								<option value="BBIT">Business Information Technology</option>
							</select><br/>
					</div>
				</div>
			</div>
			<!-- school id -->
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
					<input class="form-control" type="text" name="schoolid" required placeholder="School ID" value="<?php if(isset($_POST['schoolid'])) $_POST['schoolid'];?>" /><br/>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
					<input class="form-control" type="Email" name="email" required placeholder="Email@ueab.ac.ke" value="<?php if(isset($_POST['email'])) $_POST['email'];?>"/><br/>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
					<input class="form-control" type="Password" required placeholder="Choose Password" name="firstpasswd" id="firstpasswd"/><br/>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4">
					<input class="form-control" type="Password" required placeholder="Re-enter Password" name="reenterpasswd" id="reenterpasswd" disabled/><br/>
				</div>
			</div>			
			<div class="row">
				<div class="col-xs-offset-4 col-xs-4 col-md-offset-5 col-md-2 col-lg-offset-5 col-lg-2">
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_signup" id="submit_signup" disabled>Sign Up</button>
				</div>
			</div>
		</form>
		</div><?php
	}?>
</div></body>
<?php exit();?>
