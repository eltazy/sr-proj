<?php
	if(!isset($_SESSION)) session_start();
	
	include_once '../_class/StudentManager.class.php';
	include_once '../_class/LecturerManager.class.php';
	include_once '../_class/IdeaAbstractionManager.class.php';

	include '_pages/header.php';?>
<head>
	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="_scripts/user.js"></script>
</head>
<body>
	<div class="container-fluid" id="pagecontent">
		<?php

		if(isset($_GET['change'])){
			$message = $_GET['change'];
			switch ($message){
				case 'changepwdsuccess':
					echo '<div class="row"><label class="success_message"> Your password was changed successfully</label></div>';		
					break;
			}
			unset($_GET['change']);
		}
		if(isset($_GET['user'])){
			$username = $_GET['user'];
			$user_type = $_GET['type'].'Manager';
				$manager = new $user_type(__db());
				// get user info
				$user = $manager->get($username);
				echo "<title>".$user->firstname()."'s Profile</title>";
			if(isset($_POST['submit_delete_user'])){
				$user_type::delete($username, __db());
				header("Location: search.php?pall=on&uall=on&search=".$username);
				exit();
			}
				?>
				<!-- show user details -->
			<div class="row">
				<div class="col-sx-offset-1 col-sx-11 col-md-offset-1 col-md-6">
					<h1><?=$user->fullname()?></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-sx-offset-1 col-sx-11 col-md-offset-1 col-md-6">
					<form id="user_actions" action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
						<button class="btn btn-danger" id="delete" name="submit_delete_user">Delete</button>
						<button class="btn btn-success" id="update" type="submit" name="submit_edit_user">Update</button>
					</form>
				</div>
			</div>
			<div class="col-sx-offset-1 col-sx-11 col-md-offset-1 col-md-3">
				<div class="row"><label><u>Details</u></label></div>
				<div class="row"><label>Firstname:</label> <?= $user->firstname() ?></div>
				<div class="row"><label>Middlename:</label> <?= $user->middlename() ?></div>
				<div class="row"><label>Lastname:</label> <?= $user->lastname() ?></div>
				<div class="row"><label>Username:</label> <?= $user->username() ?></div>
				<div class="row"><label>User Type:</label> <?= $user->type() ?></div>
			</div>
			<div class="col-md-5"><?php
					$projects = IdeaAbstractionManager::getProjects($user->username(), __db());?>
					<div class="row"><label><u>Projects</u> (<?= count($projects)?>)</label> <?php
					echo '<ul>';
					foreach ($projects as $p) {?>
							<li><a href="http://localhost/sr-proj/project.php?uid=<?= $p['uid'] ?>"><?= IdeaAbstractionManager::getTitle($p['uid'], __db()) ?></a></li>
					<?php }
					echo '</ul>';
					?>
				</div>
			</div><?php
		}
		else header("Location: search.php");
				?>
		</div>
	</div>
</body>
<?php include_once '_pages/footer.php'; exit() ?>