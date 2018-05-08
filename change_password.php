<?php
    if(!isset($_SESSION)) session_start();

    include_once '_class/AuthenticationManager.class.php';
    include '_pages/header.php';?>
<head>
    <script src="_scripts/signup.js"></script>
</head>
<body>
	<div class="container-fluid" id="pagecontent">
<?php
    if(isset($_SESSION['repsyst_session_username'])){
        if(isset($_POST['submit_changepwd'])){
            $curr_user = new Authentication($_SESSION['repsyst_session_username'], md5($_POST['current_password']));
            $database = new PDO($dbconnexion, $dbuser, $dbpwd);
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
        } ?>
        <div class="col-md-offset-3 col-md-6">
            <div class="row"><h1>Change Password</h1></div>
            <?php if(isset($_GET['change'])){
                echo '<div class="row"><div class="col-md-12">';
                $message = $_GET['change'];
                switch ($message) {
                    case 'notmatching':
                        echo '<div class="alert alert-danger"><b>The new and re-entered passwords do not match!</b></div>';
                        break;
                    case 'wrongpwd':
                        echo '<div class="alert alert-danger"><b>Password incorrect.</b></div>';
                        break;
                    case 'retry':
                        echo '<div class="alert alert-danger"><b>Something went wrong. Please retry.</b></div>';
                        break;
                }
                echo '</div></div>';
                unset($_GET['change']);
            } ?>
            <form class="form-signin" action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="form-group">
                    <label>Current Password</label>
                    <input class="form-control" type="password" name="current_password">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input class="form-control" type="password" name="new_password" id="firstpasswd">
                </div>
                <div class="form-group">
                    <label>Re-enter new Password</label>
                    <input class="form-control" type="password" name="new_password_biss" id="reenterpasswd" disabled>
                </div>
                <button class="btn btn-success" type="submit" name="submit_changepwd" id="submit_signup" disabled>Submit</button>
            </form>
        </div>
        <?php
    }
    else header("Location: login.php");
?>
    </div>
</body>
<?php include_once '_pages/footer.php'; exit();