<?php
    include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/StudentManager.class.php';
    include_once '_class/LecturerManager.class.php';

	include '_pages/header.php';?>
    <script src="_scripts/project.js"></script>
    <script src="_scripts/upload.js"></script>
    <body>
        <div class="container-fluid" id="pagecontent">
    <?php
    //handling login error messages
    // if(isset($_GET['update'])){
    //     $update = $_GET['update'];
    //     switch ($update) {
    //         case 'success': echo '<label class="success_message">Project successfully updated</label><br/>'; break;
    //         case 'failure': echo '<label class="error_message">Project Update failed</label><br/>'; break;
    //     }
    //     unset($_GET);
    // }
    
    $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['submit_cancel'])){
        unset($_SESSION['temp_uid']);
        header("Location: http://localhost/sr-proj/project.php?uid=".$_POST["uid"]);
    }
	else if(isset($_POST['submit_save'])){
        unset($_SESSION['temp_uid']);
        // update project here
        $temp_project = array(  "title" => $_POST["title"],
                                "description" => $_POST["description"],
                                "links" => $_POST["links"],
                                "coauthors" => $_POST["authors"],
                                "keywords" => $_POST["keywords"],
                                "state" => $_POST["state"] );            
        $idea_manager = new IdeaAbstractionManager($database);
        $idea_manager->update($_POST["uid"], $temp_project);
        header("Location: http://localhost/sr-proj/project.php?uid=".$_POST["uid"]);        
    }
    else if(isset($_GET['uid'])){
        $uid = $_GET['uid'];

        $manager = new IdeaAbstractionManager($database);
        $project = $manager->get($uid);
        $_SESSION['temp_uid'] = $project->uid();
        // print_r($project);
        $type = str_replace(' ', '', $project->type());
        // customizing page title eg. "My research's title blahblabla - Research"
        echo '<title>Edit project: '.$project->title().'</title>';?>
        <div class="col-md-offset-3 col-md-6">
            <h3>Edit <?=$project->type()?></h3>
            <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" type="text" name="title" value="<?=$project->title()?>">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" cols="30" rows="10"><?=$project->description()?></textarea>               
                </div>
                <div class="form-group">
                    <label>Links</label>
                    <input class="form-control" type="text" name="links" value="<?=$project->links()?>">
                </div>
                <div class="form-group">
                    <label>Co-Authors</label>
                    <input class="form-control" type="text" id="coauthors" name="authors" value="<?=$project->coauthors()?>">
                    <div id="user_suggestion_box"></div>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select class="form-control" name="state" placeholder="-Select Type-" class="textfield" required>
                        <?php
                            foreach (get_class($project)::getStates() as $state){
                                $selected = $state==$project->type() ? 'selected' : '';
                                echo '<option value="'.$state.'" '.$selected.'>'.$state.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keywords</label>
                    <input class="form-control" type="text" id="topics" name="keywords" value="<?=$project->keywords()?>">
                        <div id="topic_suggestion_box"></div>
                </div>
                <!-- <div class="form-group">
                    <label>Add a File</label>
                    <input class="form-control" type="hidden" id="uniqueid" name="uid" value="<?= $project->uid() ?>">
                    <input type="text" id="filename" name="filename">
                    <input type="file" id="files" name="files">
                    <a href="#topics" id="upload" name="upload">Upload</a>
                    <progress id="prog" value="0" min="0" max="100"></progress>
                </div> -->
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="submit_save">Save</button>
                    <button class="btn btn-default" type="submit" name="submit_cancel">Cancel</button>
                </div>
            </form>
        </div><?php        
	}
	else header("Location: index.php");
?>
</div>
</body>
<?php include_once '_pages/footer.php'; exit();