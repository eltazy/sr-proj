<?php
    if(!isset($_SESSION)) session_start();
    
    include '_pages/header.php';
	include_once '_class/StudentManager.class.php';
    include_once '_class/LecturerManager.class.php';

	if(isset($_POST['submit_update_profile'])){
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $UserManager = $_SESSION['repsyst_session_type'].'Manager';
        $UserManager = new $UserManager($database);
        $e= $UserManager->update($_SESSION['repsyst_session_username'], $_POST);
        header("Location: profile.php?user=myprofile");
        $new_session_user = $UserManager->get($_SESSION['repsyst_session_username']);
        $_SESSION['repsyst_session_fullname'] = $new_session_user->fullname();
        $_SESSION['repsyst_session_firstname'] = $new_session_user->firstname();
        $_SESSION['repsyst_session_middlename'] = $new_session_user->middlename();
        $_SESSION['repsyst_session_lastname'] = $new_session_user->lastname();
        $_SESSION['repsyst_session_gender'] = $new_session_user->gender();
        $_SESSION['repsyst_session_type'] = $new_session_user->type();
        $_SESSION['repsyst_session_email'] = $new_session_user->email();
    }
?>
<head>
    <script src="_scripts/jquery-3.3.1.min.js"></script>
    <script>
        var main = function(){
            $("#upload").on('change',function(e){
                e.preventDefault();
                $(this).ajaxSubmit({
                    beforeSend:function(){
                        $("#prog").show();
                        $("#prog").attr('value','0');
                    },
                    uploadProgress:function(event,position,total,percentComplete){
                        $("#prog").attr('value',percentComplete);
                    },
                    success:function(data){
                        $("#here").html(data);
                    }
                });
            });
        };
        $(document).ready(main);
    </script>
    <title>Edit Profile</title>
</head>
<body>
    <div class="container-fluid" id="pagecontent">
        <div class="col-sx-offset-1 col-sx-11 col-md-offset-1 col-md-4">
            <!-- <form id="upload" method="POST" enctype="multipart/form-data">
                <input type="file" name="profile_picture">
                <input type="file" name="profile_picture" accept="image/*">
                TODO:(8) (AJAX, Javascript) process file upload
                <button type="submit" name="submit_picture">Change picture</button>
            </form>
            <progress id="prog" max="100" value="0" style="display: none;"></progress>
            <div id="here"></div> -->
            <h1>Edit profile</h1><br>
            <form class="form-signin" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <!-- <img class="img-profile" src="<?= $_SESSION['repsyst_session_profilepic'] ?>"> -->
                
                <div class="form-group">
                    <label>Firstname</label>
                    <input class="form-control" type="text" name="p_firstname" value="<?= $_SESSION['repsyst_session_firstname'] ?>">
                </div>
                <div class="form-group">
                    <label>Middlename</label>
                    <input class="form-control" type="text" name="p_middlename" value="<?= $_SESSION['repsyst_session_middlename'] ?>">
                </div>
                <div class="form-group">
                    <label>Lastname</label>
                    <input class="form-control" type="text" name="p_lastname" value="<?= $_SESSION['repsyst_session_lastname'] ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" name="p_email" value="<?= $_SESSION['repsyst_session_email'] ?>">
                </div>                
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="text" name="p_username" value="<?= $_SESSION['repsyst_session_username'] ?>" disabled>
                </div>
                <div class="row">
                    <div class=" col-md-4 col-lg-4">
                        <button class="btn btn-success" type="submit" name="submit_update_profile">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<?php include_once '_pages/footer.php'; exit() ?>
