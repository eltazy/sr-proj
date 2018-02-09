<?php
    if (!isset($_SESSION)) session_start();
    
    include_once '_class/IdeaAbstractionManager.class.php';
    include_once '_class/Idea.class.php';
    include_once '_class/Project.class.php';
    include_once '_class/SeniorProject.class.php';
    include_once '_class/Research.class.php';

	include '_pages/header.php';

    if(isset($_SESSION['repsyst_session_username'])){
		if(isset($_POST['submit_addproject'])){
            $title = ucfirst($_POST['title']);
            $description = ucfirst($_POST['description']);
            $postedby = $_SESSION['repsyst_session_username'];
            $coauthors = strtolower($_POST['co_authors']);
            $keywords = strtolower($_POST['keywords']);
            $type = strtoupper($_SESSION['new_type']);
            $docs = ""; $uid = "";
            $links = strtolower($_POST['links']);

            $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Generating unique identifier
            do $uid = strtoupper(substr(sha1($type.$title.uniqid()), -12));
            while (IdeaAbstractionManager::uidExists($uid, $database));

            # Check files upload
            # TODO: (Javascript) file uploading process
            $success = true;
            for($i = 0, $size = count($_FILES['uploads']['name']); $i < $size; $i++){
                if($_FILES['uploads']['error'][$i] > 0) $success = false;
                else{
                    $file_name = $_FILES['uploads']['name'][$i];
                    $file_temp_name = $_FILES['uploads']['tmp_name'][$i];
        
                    $file_extension = explode('.', $file_name);
                    $file_extension = strtolower(end($file_extension));
        
                    $allowed_file_extensions = array('pdf', 'doc', 'odt', 'odp', 'docx', 'ppt', 'pptx', 'ppsx', 'pps');
        
                    if(in_array($file_extension, $allowed_file_extensions)){
                        if($_FILES['uploads']['size'][$i] < 20971520) { //less than 20MB
                            $new_filename = '_uploads/_documents/'.$uid.'.'.$file_extension;
                            move_uploaded_file($file_temp_name, $new_filename);
                            $docs = $docs.';'.$new_filename;
                        }
                        else $success = false;
                    }
                    else $success = false;
                }
            }
            #Building array to pass to constructor
            $t_project = array('uid'=>$uid,
                                'title'=>$title,
                                'type'=>$type,
                                'description'=>$description,
                                'coauthors'=>$coauthors,
                                'postedby'=>$postedby,
                                'docs'=>$docs,
                                'links'=>$links,
                                'keywords'=>$keywords);
            #Check type
            $my_idea="";
            switch ($type) {
                case Type::_IDEA:
                    $my_idea = new Idea($t_project);
                    break;
                case Type::_PROJECT:
                    $my_idea = new Project($t_project);
                    break;
                case Type::_SENIOR_PROJECT:
                    $my_idea = new SeniorProject($t_project);
                    break;
                case Type::_RESEARCH:
                    $my_idea = new Research($t_project);
                    break;
            }
            $idea_manager = new IdeaAbstractionManager($database);
            $idea_manager->add($my_idea);

            #Returns error message if files could not be uploaded fully
            if($success) header("Location: newproject.php?new=projectadded&id=".$uid);
            else header("Location: newproject.php?new=filesupload");
        }
		else header("Location: newproject.php");
	}
	else header("Location: login.php");
?>