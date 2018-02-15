<?php 
    include_once '_class/SearchManager.class.php';
    
	include_once "_pages/header.php";
?>
<head>
    <title>Search</title>
    <script src="_scripts/jquery-3.3.1.min.js"></script>
    <script src="_scripts/search.js"></script>
</head>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="search_form" id="search_form" method="get">
    <input type="text" name="search" id="search" placeholder="Search" <?php
         if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>>
    <button type="submit">Search</button></br>
    <input type="checkbox" name="uall" id="uall" onChange="beforeUSubmit(this)"<?php
         if(isset($_GET['uall'])) echo 'checked="checked"'; ?>><b><i>All users</i></b>
    <div id="checkUOptions">
        <input type="checkbox" name="ostu" id="ostu" value="Students" onChange="beforeUSubmit(this)"<?php
            if(isset($_GET['ostu'])) echo 'checked="checked"'; ?>>Students
        <input type="checkbox" name="olec" id="olec" value="Lecturers" onChange="beforeUSubmit(this)"<?php
            if(isset($_GET['olec'])) echo 'checked="checked"'; ?>>Lecturers
    </div>
    <input type="checkbox" name="pall" id="pall" onChange="beforeWSubmit(this)"<?php
         if(isset($_GET['pall'])) echo 'checked="checked"'; ?>><b><i>All projects</i></b>
    <div id="checkWOptions">
        <input type="checkbox" name="osrp" id="osrp" value="Senior Project" onChange="beforeWSubmit(this)"<?php
            if(isset($_GET['osrp'])) echo 'checked="checked"'; ?>>Senior Projects
        <input type="checkbox" name="oprj" id="oprj" value="Project" onChange="beforeWSubmit(this)"<?php
            if(isset($_GET['oprj'])) echo 'checked="checked"'; ?>>Projects
        <input type="checkbox" name="ores" id="ores" value="Research" onChange="beforeWSubmit(this)"<?php
            if(isset($_GET['ores'])) echo 'checked="checked"'; ?>>Researches
        <input type="checkbox" name="oid" id="oid" value="Idea" onChange="beforeWSubmit(this)"<?php
            if(isset($_GET['oid'])) echo 'checked="checked"'; ?>>Ideas
    </div>
</form>
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