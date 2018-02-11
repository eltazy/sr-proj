<?php 
    include_once '_class/SearchManager.class.php';
    
	include_once "_pages/header.php";
?>
<form action="search.php" name="search_form" id="search_form" method="get">
    <input type="text" name="search" id="search" placeholder="Search" <?php
         if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>>
    <button type="submit">Search</button></br>
    <input type="checkbox" name="uall" id="uall" value="all users" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['uall'])) echo 'checked="checked"'; ?>><b><i>All users</i></b>
    <input type="checkbox" name="ostu" id="ostu" value="STUDENTS" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['ostu'])) echo 'checked="checked"'; ?>>Students
    <input type="checkbox" name="olec" id="olec" value="LECTURERS" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['olec'])) echo 'checked="checked"'; ?>>Lecturers</br>
    <input type="checkbox" name="pall" id="pall" value="all project" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['pall'])) echo 'checked="checked"'; ?>><b><i>All projects</i></b>
    <input type="checkbox" name="osrp" id="osrp" value="SENIOR PROJECT" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['osrp'])) echo 'checked="checked"'; ?>>Senior Projects
    <input type="checkbox" name="oprj" id="oprj" value="PROJECT" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['oprj'])) echo 'checked="checked"'; ?>>Projects
    <input type="checkbox" name="ores" id="ores" value="ACADEMIC RESEARCH" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['ores'])) echo 'checked="checked"'; ?>>Researches
    <input type="checkbox" name="oid" id="oid" value="IDEA" onChange="beforeSubmit(this)"<?php
         if(isset($_GET['oid'])) echo 'checked="checked"'; ?>>Ideas</br>
</form>
<script>
// TODO:(6) (Javascript) auto-enable all sub-checkboxes when either 'All users' or 'All project' options is selected and disable parent when a child option is disabled -->
//! FIXME: function should check/uncheck all elements when all is checked/unchecked
    function beforeSubmit(element){
        var myform = document.search_form;
        // document.getElementbyId("ostu").checked="checked";
        // stu.checked = true;
        // var ck_all_users = document.uall;
        // var ck_all_projects = document.pall;
        // if(ck_all_users.checked){
        //     document.ostu.setAttribute('checked', 'checked');
        //     document.olec.setAttribute('checked', 'checked');
        //     // document.ostu.checked = 'checked';
        //     // document.olec.checked = 'checked';
        // }
        myform.submit();
    }
</script>
<?php
    if(isset($_GET['search']) && $_GET['search'] != ''){
        $search_str = $_GET['search'];
        $user_options = array();
            if(isset($_GET['ostu'])) array_push($user_options, $_GET['ostu']);
            if(isset($_GET['olec'])) array_push($user_options, $_GET['olec']);
        $project_options = array();
            if(isset($_GET['oid'])) array_push($project_options, $_GET['oid']);
            if(isset($_GET['ores'])) array_push($project_options, $_GET['ores']);
            if(isset($_GET['oprj'])) array_push($project_options, $_GET['oprj']);
            if(isset($_GET['osrp'])) array_push($project_options, $_GET['osrp']);
        $search = new Search($search_str, $user_options, $project_options);
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $search_manager = new SearchManager($database);
        $search_results = $search_manager->search($search);
        foreach ($search_results as $collection) {
            echo $collection->heading().'<br>';
            foreach ($collection->results() as $o) echo $o.'<br>';
            echo '<br><br>';
        }
    }
    else echo '<br><br><h1>Nothing to show</h1>';
?>