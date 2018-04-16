<?php
	if (!isset($_SESSION)) session_start();
    
    include_once '_class/IdeaAbstractionManager.class.php';

	include '_pages/header.php';
?>
<head>
	<title>New Project</title>
    <script src="_scripts/project.js"></script>
</head>
<body>
    <div class="container-fluid" id="pagecontent">
            <div class="col-md-offset-3 col-md-6">
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
            $coauthors = $postedby.';'.$_POST['coauthors'];
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
            header("Location: project.php?uid=".$uid);
            // else header("Location: project.php?new=filesupload");
		}
		else{ ?>
                <h3>Add new work</h3>
                <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" placeholder="Title" class="textfield" required></label>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" placeholder="Describe your work..." name="description" cols="30" rows="10" class="textfield" required></textarea></label>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="type" placeholder="-Select Type-" class="textfield" required>
                                <option disabled selected hidden>-Select Type-</option>
                                <option value="Idea">Idea</option>
                                <option value="Project">Project</option>
                                <option value="Senior Project">Senior Project</option>
                                <option value="Research">Research</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Co-Authors</label>
                            <input class="form-control" type="text" name="coauthors" id="coauthors" class="textfield"placeholder="author1; author2; author3;...">
                            <div id="user_suggestion_box"></div>
                        </div>
                        <div class="form-group">
                            <label>Links</label>
                            <input class="form-control" type="text" class="textfield" name="links" placeholder="link1; link2; link3;..."></label>
                        </div>
                        
                        <div class="form-group">
                            <label>Topics</label>
                            <input class="form-control" type="text" class="textfield" name="topics" id="topics" placeholder="keyword1; keyword2; keyword3;..." required>
                            <div id="topic_suggestion_box"></div>
                        </div>
                        <!-- TODO:(8) (AJAX-Javascript) process files upload status -->
                        <!-- <tr><label>Files:</label><input name="uploads[]" type="file" multiple="multiple" accept=".odp, .pdf, .odt, .doc, .docx, .ppt, .pptx, .ppsx, .pps"/></label> -->
                        <button class="btn btn-primary" type="submit" name="submit_addproject">Save</button>
                    </table>
                </form>
            </div><?php
        }
	}
	else header("Location: login.php");
?>
</div>
</body>
<?php 
    include_once '_pages/footer.php';
    exit(); ?>