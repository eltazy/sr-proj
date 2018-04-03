<!-- Page header -->
<?php if (!isset($_SESSION)) session_start(); ?>
<head>
    <meta charset="utf-8" />
	<!-- TODO:(7) (CSS) Change styling -->
	<link rel="stylesheet" type="text/css" href="style.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<header>
	<div id="pageheader">
        <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid" id="navheader">
                    <a class="navbar-header" href="index.php">
                        <img alt="Brand" src="./_css_images/50px_ueab_logo.png">
                    </a>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="newproject.php">New Project</a></li>
                            <li><a href="topic.php">Topics</a></li>
                        </ul>
                        <?php
                            if(basename($_SERVER["SCRIPT_FILENAME"], '.php') != 'search'){ ?>                                
                                <form class="navbar-form navbar-left" action="./search.php" name="search_form" method="get">
                                    <div class="form-group">
                                        <input type="hidden" name="uall" value="all users" checked="checked">
                                        <input type="hidden" name="pall" value="all projects" checked="checked">
                                        <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-default">Search</button>
                                </form>
                        <?php
                        } ?>
                    <ul class="nav navbar-nav navbar-right" id="navbarheader">                        
                        <?php
                            if (isset($_SESSION['repsyst_session_username'])) {
                                $sess_username = $_SESSION['repsyst_session_username'];
                                $sess_name = $_SESSION['repsyst_session_fullname'];
                                $sess_user_gender = $_SESSION['repsyst_session_gender'];
                                // $profile_pic_path = './_uploads/_profiles/profile_'.$sess_username;
                                // if (file_exists($profile_pic_path)){
                                //     echo '<img src="'.$profile_pic_path.'">';
                                //     $_SESSION['repsyst_session_profilepic'] = '_uploads/_profiles/profile_'.$sess_username;
                                // }
                                // else{
                                //     if($sess_user_gender == 'male'){
                                //         echo '<img src="./_uploads/_default/male_default.jpg">';
                                //         $_SESSION['repsyst_session_profilepic'] = '_uploads/_default/male_default.jpg';
                                //     }
                                //     else if($sess_user_gender == 'female'){
                                //         echo '<img src="./_uploads/_default/female_default.jpg">';
                                //         $_SESSION['repsyst_session_profilepic'] = '_uploads/_default/female_default.jpg';
                                //     }
                                // } ?>
                                
                                <li class="dropdown">
                                    <a href="#" id="dropname" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $sess_name ?><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="./profile.php?user=myprofile">My Profile</a></li>
                                        <li><a href="./logout.php">Logout!</a></li>
                                    </ul>
                                </li>
                                <?php
                            }
                            else{?>
                                <li><a href="./signup.php">Signup</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="./login.php">Login</a></li>
                            <?php }
                        ?>
                        </ul>
            </div>
            </div>
        </nav>
    </div>
</header>