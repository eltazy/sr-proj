<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Add New Idea</title>
	</head>

	<body>
		<form method="post" action="newIdea.php">
			Title : <input type="text" name="title" /><br/>
			Description : <textarea name="description" cols="40" rows="5"></textarea><br/>
			Authors : <input type="text" name="authors" /><br/><br/>
			Keywords : <input type="text" name="keywords" />separate keywords with semi-colon<br/>
			<input type="submit">
		</form>
	</body>
</html>