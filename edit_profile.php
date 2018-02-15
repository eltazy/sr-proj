<?php
	if(!isset($_SESSION)) session_start();
    include '_pages/header.php';
	if(!isset($_POST['submit_edit_profile'])){
    }
?>
<form action="upload_profile.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="profile_picture" accept="image/*">
    <!-- TODO:(8) (AJAX, Javascript) process file upload -->
	<button type="submit" name="submit_picture">Change picture</button>
</form>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <img class="img-profile" src="<?php echo $_SESSION['repsyst_session_profilepic'] ?>"></br>
    Firstname:<input type="text" name="p_firstname" value="<?php echo $_SESSION['repsyst_session_firstname'] ?>"></br>
    Middlename:<input type="text" name="p_middlename" value="<?php echo $_SESSION['repsyst_session_middlename'] ?>"></br>
    Lastname:<input type="text" name="p_lastname" value="<?php echo $_SESSION['repsyst_session_lastname'] ?>"></br>
	<!-- IMPLEMENT: (AJAX, jQuery) check username availability as you type -->
    Username:<input type="text" name="p_username" value="<?php echo $_SESSION['repsyst_session_username'] ?>" disabled></br>
    <button type="submit" name="submit_save_changes">Save changes</button>
</form>
