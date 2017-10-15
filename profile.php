<?php
	if(!isset($_SESSION)) session_start();
	include '_pages/header.php';
	
	if(isset($_GET['change']) && $_GET['change'] != ''){
		$message = $_GET['change'];
		switch ($message){
			case 'changepwdsuccess':
				echo '<label class="success_message">Your password was changed successfully</label></br>';		
				break;
		}
		unset($_GET['change']);
	}

?>
<form action="edit_profile.php" method="POST">
    <img class="img-profile" src="<?php echo $_SESSION['repsyst_session_profilepic'] ?>"></br>
    Firstname: <label><?php echo $_SESSION['repsyst_session_firstname'] ?></label></br>
    Middlename:<label><?php echo $_SESSION['repsyst_session_middlename'] ?></label></br>
    Lastname:<label><?php echo $_SESSION['repsyst_session_lastname'] ?></label></br>
    Username:<label><?php echo $_SESSION['repsyst_session_username'] ?></label></br>
    E-mail:<label><?php echo $_SESSION['repsyst_session_email'] ?></label></br>
    <button type="submit" name="submit_edit_profile">Edit Profile</button></br>
</form>
<form action="change_password.php" method="POST">
    <button type="submit" name="submit_change_password">Change Password</button></br>
</form>