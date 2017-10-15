<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<title>Sign Up!</title>
</head>

<section class="main-container">
	<div class="main-wrapper">
		<h1>Signup</h1>
		<form class="signup-form" method="post" action="signup.php">
			<input type="text" name="firstname" placeholder="First Name" value="<?php if(isset($_POST['firstname'])) $_POST['firstname'];?>" /><br/>
			<input type="text" name="middlename" placeholder= "Middle Name" value="<?php if(isset($_POST['middlename'])) $_POST['middlename'];?>" /><br/>
			<input type="text" name="lastname" placeholder="Last Name" value="<?php if(isset($_POST['lastname'])) $_POST['lastname'];?>" /><br/>
			<div class="select-style">
				<select name="gender" required placeholder="Last Name">
					<option value="Select" disabled selected hidden>Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			</div>
			<?php if($_POST['type'] == 'Student'){ ?>
			<div class="select-style">
				<select name="major" required>
					<option value="Select" disabled selected hidden>Major</option>
					<option value="SWEN">Software Engineering</option>
					<option value="NETW">Networking</option>
					<option value="BBIT">Business Information Technology</option>
				</select>
			</div>
			<input type="text" name="schoolid" placeholder="School ID" value="<?php if(isset($_POST['schoolid'])) $_POST['schoolid'];?>" />
			<?php } ?>
			<input type="Email" name="email" placeholder="Email@ueab.ac.ke" value="<?php if(isset($_POST['email'])) $_POST['email'];?>"/>
			<input type="Password" placeholder="Password" name="firstpasswd"/>
			<input type="Password" placeholder="Re-enter Password" name="reenterpasswd"/>
			<button type="submit" name="submit_signup">Sign Up</button>
		</form>
	</div>
</section>