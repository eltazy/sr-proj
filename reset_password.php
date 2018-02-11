<?php
    include_once '_class/AuthenticationManager.class.php';

    include '_pages/header.php';?>
    
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Reset Password</title>
    </head><?php 
    
    if(isset($_SESSION['repsyst_session_username'])) header("Location: forgot_password.php?message=loggedin");
    else if(isset($_POST['submit_reset_password'])){
        $new_pwd=$_POST['new_password'];
        $username = $_POST['u'];

		$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $temp_cred = new AuthenticationManager($database);
        $temp_auth = $temp_cred->get($username);
        $temp_cred->updatePassword($temp_auth, md5($new_pwd));
        unset($_POST);
        unset($_GET);
        header("Location: login.php?login=pwd_changed");
    }
    else{
        if(isset($_GET['u']))
        // TODO:(5) (Javascript) enable submit button only if both passwords match
            echo   '<form action="reset_password.php" method="POST">
                            Your username is <label class="success_message">'.$_GET['u'].'.<br/>
                            <input type="hidden" name="u" value="'.$_GET['u'].'" />
                            Enter new Password: <input type="password" name="new_password" required></br>
                            Re-enter new Password: <input type="password" name="new_password_biss" required></br>
                            <button type="submit" name="submit_reset_password">Submit</button>
                        </form>';
        else header("Location: index.php");
        }