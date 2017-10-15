<?php
    if (!isset($_SESSION)) session_start();
	include_once("_pages/header.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
	<body>
		Sign up now!
		<form method="post" action="signup.php">
			<input type="submit" name="type" value="Student">
			<input type="submit" name="type" value="Lecturer">
		</form>
		or <a href="login.php">Log in!</a>
	</body>
</html>