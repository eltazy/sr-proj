<!-- Page header -->
<?php if (!isset($_SESSION)) session_start(); ?>
<head>
    <meta charset="utf-8" />
	<!-- TODO:(7) (CSS) Change styling -->
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
                    if(basename($_SERVER["SCRIPT_FILENAME"], '.php') != 'search')
                        echo'<form action="./search.php" name="search_form" method="get">
                                <input type="text" name="search" id="search" placeholder="Search">
                                <input type="hidden" name="uall" value="all users" checked="checked">
                                <input type="hidden" name="pall" value="all projects" checked="checked">
                                <button type="submit">Search</button>
                            </form>';
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
                                echo '<img class="img-circle" src="./_uploads/_default/male_default.jpg">';
                                $_SESSION['repsyst_session_profilepic'] = '_uploads/_default/male_default.jpg';
                            }
                            else if($sess_user_gender == 'female'){
                                echo '<img class="img-circle" src="./_uploads/_default/female_default.jpg">';
                                $_SESSION['repsyst_session_profilepic'] = '_uploads/_default/female_default.jpg';
                            }
                        }
                        echo    '<form action="./logout.php" method="POST">
                                    <button type="submit" name="submit_logout">Log out</button>
                                </form>';
                    }
                    else echo '<a href="./login.php">Login</a> <label> or </label><a href="./signup.php">Signup</a>';
                ?>
            </div>
        </div>
    </nav>
</header>