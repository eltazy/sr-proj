<!-- Page header -->
<?php
    if (!isset($_SESSION)) session_start();
    include_once '../_class/_config/db.php';

    // showing errors on linux
    ini_set('display_errors', 1);
?>
<head>
    <meta charset="utf-8" />
<!-- icon -->
    <link rel="shortcut icon" href="_css_images/ueab_icon.ico" />
<!-- fontawesome icons -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<!-- custom styling -->
	<link rel="stylesheet" type="text/css" href="style.php">
<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<nav class="navbar navbar-default navbar-fixed-top" id="pageheader">
    <div class="container-fluid" id="navheader">
        <a class="navbar-header" href="index.php">
            <img alt="Brand" src="./_css_images/ueab_logo.png">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navigation">
                <li><a href="index.php"><b>Home</b></a></li>
                <li><a href="newproject.php"><b>New Project</b></a></li>
                <li><a href="topic.php"><b>Topics</b></a></li>
            </ul>
            <?php
                $basename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
                if(!in_array($basename, array('search', 'topic'))){ ?>                                
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
        <ul class="nav navbar-nav navbar-right">                        
            <?php
                if (isset($_SESSION['repsyst_session_username'])) {
                    $sess_name = $_SESSION['repsyst_session_fullname']; ?>                    
                            <li><a href="./profile.php?user=myprofile"><b><?= $sess_name ?></b></a></li>
                            <li><a href="./logout.php"><b>Logout</b></a></li>
                    <?php
                }
                else{?>
                    <li><a href="./signup.php"><b>Signup</b></a></li>
                    <li><a href="./login.php"><b>Login</b></a></li>
                <?php }
            ?>
            </ul>
        </div>
    </div>
</nav>