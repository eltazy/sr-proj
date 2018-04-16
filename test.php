<?php
// unset($GLOBALS['php_errormsg']);
session_start();
echo"FILES:";print_r($_FILES);echo"<br>";
// echo"GLOBALS:";print_r($GLOBALS);echo"<br>";
// echo"GLOBALS:";echo"<br>";
echo"SESSION:";print_r($_SESSION);echo"<br>";
echo"POST:";print_r($_POST);echo"<br>";?>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="<?= ini_get("session.upload_progress.name") ?>" value="myfiles" />
    <input type="file" name="file1"/>
    <input type="submit" />
</form>