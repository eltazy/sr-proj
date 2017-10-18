<!-- Page header -->
<?php
    if (!isset($_SESSION)) session_start();
?>
<head>
    <meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<header>
    <nav>
        <div class="main-wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="newproject.php">New Project</a></li>
            </ul>
            <div class="nav-login">
                <?php
                    if (isset($_SESSION['repsyst_session_username'])) {
                        $sess_username = $_SESSION['repsyst_session_username'];
                        $sess_name = $_SESSION['repsyst_session_firstname'].' '.$_SESSION['repsyst_session_lastname'];
                        $sess_user_gender = $_SESSION['repsyst_session_gender'];
                        $profile_pic_path = './_uploads/_profiles/profile_'.$sess_username;
                        echo    '<label>Hello, <a style="float: right;" href="./profile.php?user=myprofile"><b>'.$sess_name.'</b>.</a></label>';
                        if (file_exists($profile_pic_path)){
                            echo '<img class="img-circle" src="'.$profile_pic_path.'">';
                            $_SESSION['repsyst_session_profilepic'] = '_uploads/_profiles/profile_'.$sess_username;
                        }
                        else{
                            if($sess_user_gender == 'male'){
                                echo '<img class="img-circle" src="./_uploads/_profiles/male_default.jpg">';
                                $_SESSION['repsyst_session_profilepic'] = '_uploads/_profiles/male_default.jpg';
                            }
                            else if($sess_user_gender == 'female'){
                                echo '<img class="img-circle" src="./_uploads/_profiles/female_default.jpg">';
                                $_SESSION['repsyst_session_profilepic'] = '_uploads/_profiles/female_default.jpg';
                            }
                        }
                        echo    '<form action="./logout.php" method="POST">
                                    <button type="submit" name="submit_logout">Log out</button>
                                </form>';
                    } else {
                        echo '<form action="./login.php" method="POST">
                            <input type="text" name="username" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">
                            <button type="submit" name="submit_login">Login</button>
                        </form>
                        <form action="signup">
                            <button type="submit">Signup</button>
                        </form>
                        <a href="forgot.php"> or Forgot password?</a>';
                    }
                ?>
            </div>
        </div>
    </nav>
</header>