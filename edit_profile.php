<?php
	if(!isset($_SESSION)) session_start();
    include '_pages/header.php';
	if(!isset($_POST['submit_edit_profile'])){
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
</head>
<form id="upload" method="POST" enctype="multipart/form-data">
    <input type="file" name="profile_picture">
    <!-- <input type="file" name="profile_picture" accept="image/*"> -->
    <!-- TODO:(8) (AJAX, Javascript) process file upload -->
	<button type="submit" name="submit_picture">Change picture</button>
</form>
<progress id="prog" max="100" value="0" style="display: none;"></progress>
<div id="here"></div>
<form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">
    <img class="img-profile" src="<?= $_SESSION['repsyst_session_profilepic'] ?>"></br>
    Firstname:<input type="text" name="p_firstname" value="<?= $_SESSION['repsyst_session_firstname'] ?>"></br>
    Middlename:<input type="text" name="p_middlename" value="<?= $_SESSION['repsyst_session_middlename'] ?>"></br>
    Lastname:<input type="text" name="p_lastname" value="<?= $_SESSION['repsyst_session_lastname'] ?>"></br>
	<!-- IMPLEMENT: (AJAX, jQuery) check username availability as you type -->
    Username:<input type="text" name="p_username" value="<?= $_SESSION['repsyst_session_username'] ?>" disabled></br>
    <button type="submit" name="submit_save_changes">Save changes</button>
</form>
