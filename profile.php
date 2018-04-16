<?php
	if(!isset($_SESSION)) session_start();
	
	include_once '_class/StudentManager.class.php';
	include_once '_class/LecturerManager.class.php';
	include_once '_class/IdeaAbstractionManager.class.php';

	include '_pages/header.php';?>
<body>
	<div class="container-fluid" id="pagecontent">
		<?php

		if(isset($_GET['change'])){
			$message = $_GET['change'];
			switch ($message){
				case 'changepwdsuccess':
					echo '<br><b><div class="alert alert-success">Your password was changed successfully</b></div>';		
					break;
			}
			unset($_GET['change']);
		}

		if(isset($_GET['user'])){
			$username = $_GET['user'];
			$temp = isset($_SESSION['repsyst_session_username'])?$_SESSION['repsyst_session_username']:'';
			$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
			
			if ($username == 'myprofile' || $username == $temp){
				?>
				<div class="col-md-offset-1">
					<h1>My Profile</h1><br>
				</div>
				<div class="row">
					<div class="col-md-offset-1 col-md-1">
						<form action="edit_profile.php" method="POST">
							<button class="btn btn-success" type="submit" name="submit_edit_profile">Edit Profile</button>
						</form>
					</div>
					<form action="change_password.php" method="POST">
						<button class="btn btn-primary" type="submit" name="submit_change_password">Change Password</button>
					</form>
				</div>
				<div class="row">
					<div class="col-md-offset-1 col-md-10">
						<title>Profile</title>
							<label>Firstname:</label> <?=$_SESSION['repsyst_session_firstname']?><br>
							<label>Middlename:</label> <?=$_SESSION['repsyst_session_middlename']?><br>
							<label>Lastname:</label> <?=$_SESSION['repsyst_session_lastname']?><br>
							<label>Username:</label> <?=$_SESSION['repsyst_session_username']?><br>
							<label>E-mail:</label> <?=$_SESSION['repsyst_session_email']?><br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-offset-1 col-md-10">
						<h1>Projects</h1>
						<ul> <?php
							$projects = IdeaAbstractionManager::getProjects($_SESSION['repsyst_session_username'], $database);
							foreach ($projects as $p)
								echo '<li><a href="http://localhost/sr-proj/project.php?uid='.$p["uid"].'">'.IdeaAbstractionManager::getTitle($p['uid'], $database).'</a></li>'; ?>
						</ul>
					</div>
				</div>

			<?php }
			// another user's profile
			else{
				$database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
				$__Manager = $_GET['type'].'Manager';
				$manager = new $__Manager($database);
				// get user public info
				$user = $manager->getPublicInfo($username);
				echo "<title>".$user->firstname()."'s Profile</title>";
				?>
				<!-- show user details -->
				<div class="col-md-offset-1">
					<h1>User Profile</h1>
					<label>Firstname:</label> <?= $user->firstname() ?><br>
					<label>Middlename:</label> <?= $user->middlename() ?><br>
					<label>Lastname:</label> <?= $user->lastname() ?><br>
					<label>Username:</label> <?= $user->username() ?><br>
					<h1>Projects</h1> <?php
						$projects = IdeaAbstractionManager::getProjects($user->username(), $database);
						foreach ($projects as $p) {?>
								<li><a href="http://localhost/sr-proj/project.php?uid=<?= $p['uid'] ?>"><?= IdeaAbstractionManager::getTitle($p['uid'], $database) ?></a></li>
						<?php } ?>
				</div><?php
			}
		}
		else header("Location: index.php");
				?>
		</div>
	</div>
</body>
<?php include_once '_pages/footer.php'; exit() ?>