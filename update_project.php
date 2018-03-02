<?php
    include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/StudentManager.class.php';
    include_once '_class/LecturerManager.class.php';

	include '_pages/header.php';

	if(isset($_POST['submit_cancel'])){
        $uid = $_POST["uid"];
        header("Location: http://localhost/sr-proj/project.php?uid=$uid");
    }
	else if(isset($_POST['submit_save'])){
        // update project herer
    }
    if(isset($_GET['uid'])){
        $uid = $_GET['uid'];
        
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');

        $manager = new IdeaAbstractionManager($database);
        $project = $manager->get($uid);
        // print_r($project);
        $type = str_replace(' ', '', $project->type());
        // customizing page title eg. "My research's title blahblabla - Research"
        echo '<head><title>Edit: '.$project->title().'</title></head>';?>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
            <table>
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?=$project->title()?>"></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="30" rows="10"><?=$project->description()?></textarea></td>               
                </tr>
                <tr>
                    <td>Links: </td>
                    <td><input type="links" name="links" value="<?=$project->links()?>"></td>
                </tr>
                <tr>
                    <td>Authors: </td>
                    <td><input type="authors" name="authors" value="<?=$project->coauthors()?>"></td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td><select name="type" placeholder="-Select Type-" class="textfield" required>
                        <?php
                            foreach (get_class($project)::getStates() as $state){
                                // echo '<option value="'.$state.'">'.$state.'</option>';
                                $selected = $state==$project->type() ? 'selected' : '';
                                echo '<option value="'.$state.'" '.$selected.'>'.$state.'</option>';
                            }
                        ?>
                    </select></td>
                </tr>
                <tr>
                    <td>Keywords: </td>
                    <td><input type="keywords" name="keywords" value="<?=$project->keywords()?>">
                        <div id="topic_suggestion_box"></div></td>
                </tr>
                <tr>
                    <td><button type="submit_cancel">Cancel</button></td>
                    <td><button type="submit_save">Save</button></td>
                </tr>
            </table>
            <input type="hidden" name="uid" value="<?=$uid?>">
        </form><?php
        
	}
	else header("Location: index.php");
?>