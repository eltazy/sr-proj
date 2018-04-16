<?php
if(!isset($_SESSION)) session_start();
header("Content-type: text/css; charset: UTF-8");

$theme_primary_color = 'rgb(60, 160, 245)';
$nav_text_color = white;
if(isset($_SESSION['repsyst_session_type']) && $_SESSION['repsyst_session_type'] =='Lecturer')
    $_SESSION['repsyst_session_username'] == 'admin' ?
        $theme_primary_color = 'rgb(150, 50, 220)':
        $theme_primary_color = 'rgb(100, 100, 100)';
        
include_once 'style.css'; ?>
:root {
    --theme_primary_color: <?= $theme_primary_color ?>;
    --nav_text_color: <?= $nav_text_color ?>;
    --footer_ht: 50px;
    --header_ht: 70px;
}
