<?php
	if (!isset($_SESSION)) session_start();

	include '_pages/header.php';
?>
<head>
	<title>New <?php echo $_POST['type']; ?></title>
</head>
<?php
	if(isset($_SESSION['repsyst_session_username'])){
		//handling login error messages
		if(isset($_GET['new'])){
		   $new = $_GET['new'];
		   switch ($new) {
			   case 'filesupload':
				   echo '<label class="error_message">Some files failed to upload</label><br/>';
				   break;
			   case 'projectadded':
				   echo '<a href="project.php?id='.$_GET['id'].'>See project</a><br/>';
				   break;
		   }
	   }
		if(isset($_POST['type'])) include '_pages/newprojectform.php';
		else include '_pages/newprojecttype.php';
	}
	else header("Location: login.php");
?><a href=""></a>