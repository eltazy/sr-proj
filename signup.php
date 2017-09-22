<?php
	if(!isset($_SESSION)) session_start();
	if(isset($_POST['type'])) $_SESSION['user_type'] = $_POST['type'];
	else goto __EOScript;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Sign Up!</title>
	</head>
	<body>
		<form method="post" action="signedup.php">
			First Name : <input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>" /><br/>
			Middle Name : <input type="text" name="middlename" value="<?php if(isset($_POST['middlename'])) echo $_POST['middlename'];?>" /><br/>
			Last Name : <input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>" /><br/>
			Gender :
			<select name="gender">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select><br/>
			<?php if($_POST['type'] == 'Student'){?>
			Major :
			<select name="major">
				<option value="SWEN">Software Engineering</option>
				<option value="NETW">Networking</option>
				<option value="BBIT">Business Information Technology</option>
			</select><br/>
			School ID : <input type="text" name="schoolid" value="<?php if(isset($_POST['schoolid'])) echo $_POST['schoolid'];?>" /><br/><?php }?>
			Email : <input type="Email" name="email" value="@ueab.ac.ke"/> enter a valid @ueab.ac.ke email address.<br/>
			Password : <input type="Password" name="firstpasswd" /><br/>
			Re-enter Password : <input type="Password" name="reenterpasswd" /><br/>
			<input type="submit" value="Sign up">
		</form>
	</body>
</html>
<?php
	__EOScript:
	if(isset($_POST['type'])) goto __EOF;
	include('index.php');
	__EOF:
?>