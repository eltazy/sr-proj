<?php
	if (!isset($_SESSION)) session_start();
    
    include_once '_class/IdeaAbstractionManager.class.php';

	include '_pages/header.php';
?>
<head>
	<title>New Project</title>
    <!-- <style>
    body{width:610px;}
    .main-wrapper {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
    #users{float:left;list-style:none;margin-top:-3px;padding:0;width:190px;position: absolute;}
    #users li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
    #users li:hover{background:#ece3d2;cursor: pointer;}
    .textfield {padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
    </style> -->
    <script src="_scripts/jquery-3.3.1.min.js"></script>
    <script src="_scripts/project.js"></script>
</head>
<?php
	if(isset($_SESSION['repsyst_session_username'])){
		//handling login error messages
		if(isset($_GET['new'])){
		   $new = $_GET['new'];
		   switch ($new) {
				case 'filesupload':
					echo '<label class="success_message">Project added. ';
					echo '<label class="error_message">Some files failed to upload</label><br/>';
					break;
				case 'projectadded':
					echo '<label class="success_message">Project added successfully here. ';
					echo '<a href="project.php?uid='.$_GET['id'].'>See project</a><br/>';
					break;
		   }
		   unset($_GET);
	   }
		if(isset($_POST['submit_addproject'])){
            $title = ucfirst($_POST['title']);
            $description = ucfirst($_POST['description']);
            $postedby = $_SESSION['repsyst_session_username'];
            $coauthors = $_POST['coauthors'];
            $keywords = substr($_POST['topics'], 0, -1);
            $type = $_POST['type'];
            $docs = ''; $uid = '';
            $links = $_POST['links'];

            $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Generating unique identifier
            do $uid = strtoupper(substr(sha1($type.$title.uniqid()), -12));
            while (IdeaAbstractionManager::uidExists($uid, $database));

            # Check files upload
            # TODO:(8) (Javascript) file uploading process
            // $success = true;
            // for($i = 0, $size = count($_FILES['uploads']['name']); $i < $size; $i++){
            //     if($_FILES['uploads']['error'][$i] > 0) $success = false;
            //     else{
            //         $file_name = $_FILES['uploads']['name'][$i];
            //         $file_temp_name = $_FILES['uploads']['tmp_name'][$i];
        
            //         $file_extension = explode('.', $file_name);
            //         $file_extension = strtolower(end($file_extension));
        
            //         $allowed_file_extensions = array('pdf', 'doc', 'odt', 'odp', 'docx', 'ppt', 'pptx', 'ppsx', 'pps');
        
            //         if(in_array($file_extension, $allowed_file_extensions)){
            //             if($_FILES['uploads']['size'][$i] < 20971520) { //less than 20MB
            //                 $new_filename = '_uploads/_documents/'.$uid.'.'.$file_extension;
            //                 move_uploaded_file($file_temp_name, $new_filename);
            //                 $docs = $docs.';'.$new_filename;
            //             }
            //             else $success = false;
            //         }
            //         else $success = false;
            //     }
            // }
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
            $Constructor = str_replace(' ', '', $type);
            $my_idea = new $Constructor($t_project);            
            $idea_manager = new IdeaAbstractionManager($database);
            $idea_manager->add($my_idea);

            #Returns error message if files could not be uploaded fully
            // if($success)
            header("Location: newproject.php?new=projectadded&uid=".$uid);
            // else header("Location: newproject.php?new=filesupload");
		}
		else{?>
			<h1>Add new</h1>
			<section class="main-container">
				<div class="main-wrapper">
					<form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
                        <table>
                            <tr><td>Title:</td><td><input type="text" name="title" placeholder="Title" class="textfield" required></td></tr>
                            <tr><td>Description:</td><td><textarea name="description" cols="30" rows="10" class="textfield" required></textarea></td></tr>
                            <tr><td>Type:</td><td><select name="type" placeholder="-Select Type-" class="textfield" required>
                                                <option disabled selected hidden>-Select Type-</option>
                                                <option value="Idea">Idea</option>
                                                <option value="Project">Project</option>
                                                <option value="Senior Project">Senior Project</option>
                                                <option value="Research">Research</option>
                                            </select></td></tr>
                            <!-- COMPLETED (AJAX - jQuery) function to shortlist authors usernames as you type -->
                            <tr><td>Co-Authors:</td><td><input type="text" name="coauthors" id="coauthors" class="textfield"placeholder="author1; author2; author3;...">
                                <div id="user_suggestion_box"></div></td></tr>
                            <tr><td>Links:</td><td><input type="text" class="textfield" name="links" placeholder="link1; link2; link3;..."></td></tr>
                            <!-- COMPLETED (AJAX - jQuery) function to shortlist topics as you type in -->
						    <tr><td>Topics:</td><td><input type="text" class="textfield" name="topics" id="topics" placeholder="keyword1; keyword2; keyword3;..." required>
                                <div id="topic_suggestion_box"></div></td></tr>
                            <!-- TODO:(8) (AJAX-Javascript) process files upload status -->
						    <!-- <tr><td>Files:</td><td><input name="uploads[]" type="file" multiple="multiple" accept=".odp, .pdf, .odt, .doc, .docx, .ppt, .pptx, .ppsx, .pps"/></td></tr> -->
                            <tr><td></td><td><button type="submit" name="submit_addproject">Add ></button></td></tr>
                        </table>
					</form>
				</div>
			</section><?php
			
		}
	}
	else header("Location: login.php");
?>