<?php
session_start();

include '_pages/header.php';
include_once '_class/StudentManager.class.php';
include_once '_class/FileManager.class.php';
include_once '_class/IdeaAbstractionManager.class.php';

if(isset($_SESSION['repsyst_session_username'])){
    if (isset($_POST["btn_upload"])){
        if(isset($_POST[ini_get("session.upload_progress.name")])){
        $uploads_dir = '_uploads'; $name='';
            if ($_FILES["file1"]["error"] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["file1"]["tmp_name"];
                @$ext = end(explode('.', $_FILES["file1"]["name"]));
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = $_POST['description'].'-'.$_POST['uid'];
                $filename = "$uploads_dir/$name.$ext";
                move_uploaded_file($tmp_name, $filename);
                $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
                // $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $file_manager = new FileManager($database);
                $temp_file = new File($filename, $_POST['description']);
                $file_manager->add($temp_file);
                $project_manager = new IdeaAbstractionManager($database);
                $project_manager->addDocument($filename, $_GET['uid']);
            }
        ?>
        <a href="<?= $uploads_dir."/".$name ?>" target="_blank"></a>

        <?php }
        $in_user = $_SESSION['repsyst_session_username'];
    }
    ?>
    <head>
        <title>Upload</title>
        <script src="_scripts/upload.js"></script>
    </head>
    <body>
        <div class="container-fluid" id="pagecontent">
        <h1>Upload</h1>
        <div class="alert alert-danger" id="big-size-error" hidden>Error uploading. File might be too big.</div>
            <form name="upload_file" class="form-signin" action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= ini_get("session.upload_progress.name") ?>" value="myfiles" />
                <input type="hidden" name="uid" value="<?= $_GET['uid'] ?>" />
                <div class="form-group">
                    <label>File Name</label>
                    <input class="form-control" type="text" id="description" name="description" required>
                </div>
                <div class="form-group">
                    <label>Browse</label>
                    <input class="form-control" type="file" name="file1" id="file1"/>
                </div>
                <div class="form-group" id="progress-group" hidden>
                    <progress id="prog" value="0" min="0" max="100" ></progress>
                    uploading <label id="lb-processed"></label> kb of <label id="lb-total"></label> (<label id="lb-percent"></label>%)
                </div>
                <button class="btn btn-success" type="submit" id="btn_upload" name="btn_upload" disabled>
                    <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload
                </button>
            </form>

            <?php
            ?>
        </div>
    </body><?php 
    include_once '_pages/footer.php'; exit();
}
else header("Location: login.php");