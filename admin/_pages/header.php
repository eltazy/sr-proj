<!-- Page header -->
<?php if (!isset($_SESSION)) session_start() ?>
<head>
    <meta charset="utf-8" />
<!-- icon -->
    <link rel="shortcut icon" href="../_css_images/ueab_icon.ico" />
<!-- custom styling -->
	<link rel="stylesheet" type="text/css" href="../style.php">
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
            <img alt="Brand" src="../_css_images/ueab_logo.png">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav" id="navigation">
                <li><a href="students.php"><b>Dashboard</b></a></li>
                <li><a href="search.php"><b>Browse & Search</b></a></li>
                <li><a href="topic.php"><b>Topics</b></a></li>
            </ul>
        <ul class="nav navbar-nav navbar-right">                        
            <?php
                if (isset($_SESSION['repsyst_session_username'])) {
                    $sess_name = $_SESSION['repsyst_session_fullname']; ?>                    
                            <li><a href="#"><b>Admin</b></a></li>
                            <li><a href="logadminout.php"><b>Logout</b></a></li>
                    <?php
                }
                else{?>
                    <li><a href="../login.php"><b>Login</b></a></li>
                <?php }
            ?>
            </ul>
        </div>
    </div>
</nav>