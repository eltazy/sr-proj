<?php
    if (!isset($_SESSION)) session_start();

	include_once '_pages/header.php';

?>
<title>Home</title>
<body>
	<div class="container-fluid" id="pagecontent">
			<div class="col-md-offset-1 col-md-8 offset-md-1">
				<!-- recent activity -->
				<h1>Dashboard</h1>
				<?php include '_pages/dashboard.php' ?>
			</div>
	</div>
</body>
<?php include_once '_pages/footer.php';
