<?php
	if(!isset($_SESSION)) session_start();
	if(isset($_GET['changeprofilepic'])){
		$message = $_GET['changeprofilepic'];
		switch ($message){
			case 'logout':
				echo '<label class="error_message">Login first before changing profile picture</label>';		
				break;
			case 'notanimage':
				echo '<label class="error_message">You can only upload image files</label>';		
				break;
			case 'notuploaded':
				echo '<label class="error_message">There was an error uploading your file!</label>';		
				break;
			case 'bigfile':
				echo '<label class="error_message">Your file exceeds 5Mb of size</label>';		
				break;
			case 'sucess':
				echo '<label class="success_message">Profile change successfull</label>';		
				break;
		}
		$_GET['changeprofilepic'] = ''; //Re-initialize response message.
	}
    if (isset($_SESSION['repsyst_session_username'])){
		if(isset($_POST['submit_picture'])){
			$file = $_FILES['profile_picture'];

			$file_name = $file['name'];
			$file_temp_name = $file['tmp_name'];
			$file_size = $file['size'];
			$file_error = $file['error'];
			$file_type = $file['type'];

			$file_extension = explode('.', $file_name);
			$file_extension = strtolower(end($file_extension));

			$allowed_file_extensions = array('jpg', 'jpeg', 'png');

			if(in_array($file_extension, $allowed_file_extensions)){
				if($file_error === 0) {
					if($file_size < 5242880) { //less than 5MB
						$new_filename = 'profile_'.$_SESSION['repsyst_session_username'];
						$fileDestination = '_uploads/_profiles/'.$new_filename;
						move_uploaded_file($file_temp_name, $fileDestination);
						header("Location: profile.php?changeprofilepic=success");
					}
					else header("Location: profile.php?changeprofilepic=bigfile");
				}
				else header("Location: profile.php?changeprofilepic=notuploaded");
			}
			else header("Location: profile.php?changeprofilepic=notanimage");
		}
	}
	else header("Location: profile.php?changeprofilepic=logout");
?>