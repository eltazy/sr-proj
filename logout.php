<?php
    if (!isset($_SESSION)) session_start();
    // if(isset($_POST['submit_logout'])){
        session_unset();
        session_destroy();

        unset($_POST);
        unset($_GET);
        header("Location: index.php?loggedout");
        exit();
    // }
    // else 
    header("Location: index.php");
?>