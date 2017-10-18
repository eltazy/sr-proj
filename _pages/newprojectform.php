<?php 
    if (!isset($_SESSION)) session_start();
    $_SESSION['new_type'] = $_POST['type'];
?>
<h1>Add <?php echo $_POST['type'];?></h1>
<section class="main-container">
	<div class="main-wrapper">
        <form action="addproject.php" method="post" enctype="multipart/form-data">
            <label>Title:</label><input type="text" name="title" placeholder="Title" required>" /><br/>
            <label>Description:</label><textarea name="description" cols="30" rows="10" required></textarea><br/>
            <label>Co-Authors:</label><input type="text" name="co_authors" placeholder="author1; author2; author3;...">" /><br/>
            <label>Links:</label><input type="text" name="links" placeholder="link1; link2; link3;...">" /><br/>
            <label>Keywords:</label><input type="text" name="keywords" placeholder="keyword1; keyword2; keyword3;..." required>" /><br/>
            <label>Files:</label><input name="uploads[]" type="file" multiple="multiple" accept=".odp, .pdf, .odt, .doc, .docx, .ppt, .pptx, .ppsx, .pps"/><br/>
            <button type="submit" name="submit_addproject">Finish ></button><br/>
        </form>
	</div>
</section>