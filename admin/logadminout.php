<?php
if (!isset($_SESSION)) session_start();
session_unset();
session_destroy();

unset($_POST);
unset($_GET);
header("Location: index.php?loggedout");
exit();
?>