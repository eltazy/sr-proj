<?php
    if(!isset($_SESSION)) session_start();

    include_once '_class/AuthenticationManager.class.php';
    include '_pages/header.php';

    if(isset($_GET['change'])){
        $message = $_GET['change'];
        switch ($message) {
            case 'notmatching':
                echo '<label class="error_message"><b>The new and re-entered passwords do not match!</b></label>';
                break;
            case 'wrongpwd':
                echo '<label class="error_message"><b>Current password incorrect.</b></label>';
                break;
            case 'retry':
                echo '<label class="error_message"><b>Something went wrong. Please retry.</b></label>';
                break;
        }
        unset($_GET['change']);
    }
    
    if(isset($_SESSION['repsyst_session_username'])){
        // TODO: (Javascript) enable submit button only if both passwords match
        echo '<form action="change_password.php" method="POST">
                Current Password: <input type="password" name="current_password"></br>
                New Password: <input type="password" name="new_password"></br>
                Re-enter new Password: <input type="password" name="new_password_biss"></br>
                <button type="submit" name="submit_changepwd">Submit</button>
            </form>';
        if(isset($_POST['submit_changepwd'])){
            $curr_user = new Authentication($_SESSION['repsyst_session_username'], md5($_POST['current_password']));
            $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
            $temp_CredManager = new AuthenticationManager($database);
            $temp_db_cred = $temp_CredManager->get($_SESSION['repsyst_session_username']);
            if($temp_db_cred == $curr_user){
                if($_POST['new_password'] == $_POST['new_password_biss']){
                    $new_cred = new Authentication($_SESSION['repsyst_session_username'], md5($_POST['new_password']));
                    $temp_CredManager->updatePassword($temp_db_cred, $new_cred->password());
                    header("Location: profile.php?user=myprofile&change=changepwdsuccess");
                }
                else header("Location: change_password.php?change=notmatching");
            }
            else header("Location: change_password.php?change=wrongpwd");
        }
    }
    else header("Location: login.php");
?>