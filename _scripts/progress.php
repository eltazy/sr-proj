<?php
if (!isset($_SESSION)) session_start();

if (isset($_SESSION[ini_get("session.upload_progress.prefix").'myfiles'])){
    if($_SESSION[ini_get("session.upload_progress.prefix").'myfiles']["done"]) return 100;
    $length = $_SESSION[ini_get("session.upload_progress.prefix").'myfiles']["content_length"];
    $processed = $_SESSION[ini_get("session.upload_progress.prefix").'myfiles']["bytes_processed"];

    return round($processed/$length*100);
}
else return 100;
?>