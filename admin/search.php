<?php 
    include_once '../_class/SearchManager.class.php';
    
	include_once "_pages/header.php";
?>
<head>
    <title>Search</title>
    <script src="../_scripts/search.js"></script>
</head>
<body>
    <div class="container-fluid" id="searchOptions">
        <div class="col-md-12">
            <form action="<?= $_SERVER["PHP_SELF"] ?>" name="search_form" id="search_form" method="get">
                <div class="row"><div class="col-md-offset-4 col-md-4">
                    <div class="input-group">
                        <input class="form-control" type="text" name="search" id="search" placeholder="Search" <?php
                            if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>>
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="submit">Search</button>
                        </span>
                    </div>
                </div></div>
                <div class="row"><br>
                    <input class="form-check-input" type="checkbox" name="uall" id="uall" onChange="beforeUSubmit(this)"<?php
                        if(isset($_GET['uall'])) echo 'checked="checked"'; ?>><b><i>All users</i></b>
                    <input class="form-check-input" type="checkbox" name="ostu" id="ostu" value="Students" onChange="beforeUSubmit(this)"<?php
                        if(isset($_GET['uall']) || isset($_GET['ostu'])) echo 'checked="checked"'; ?>>Students
                    <input class="form-check-input" type="checkbox" name="olec" id="olec" value="Lecturers" onChange="beforeUSubmit(this)"<?php
                        if(isset($_GET['uall']) || isset($_GET['olec'])) echo 'checked="checked"'; ?>>Lecturers
                </div>
                <div class="row">
                    <input class="form-check-input" type="checkbox" name="pall" id="pall" onChange="beforeWSubmit(this)"<?php
                        if(isset($_GET['pall'])) echo 'checked="checked"'; ?>><b><i>All projects</i></b>
                    <input class="form-check-input" type="checkbox" name="osrp" id="osrp" value="Senior Project" onChange="beforeWSubmit(this)"<?php
                        if(isset($_GET['pall']) || isset($_GET['osrp'])) echo 'checked="checked"'; ?>>Senior Projects
                    <input class="form-check-input" type="checkbox" name="oprj" id="oprj" value="Project" onChange="beforeWSubmit(this)"<?php
                        if(isset($_GET['pall']) || isset($_GET['oprj'])) echo 'checked="checked"'; ?>>Projects
                    <input class="form-check-input" type="checkbox" name="ores" id="ores" value="Research" onChange="beforeWSubmit(this)"<?php
                        if(isset($_GET['pall']) || isset($_GET['ores'])) echo 'checked="checked"'; ?>>Researches
                    <input class="form-check-input" type="checkbox" name="oid" id="oid" value="Idea" onChange="beforeWSubmit(this)"<?php
                        if(isset($_GET['pall']) || isset($_GET['oid'])) echo 'checked="checked"'; ?>>Ideas
                </div>
            </form>
        </div>
    </div><hr>
    
    <?php
        if(isset($_GET['search']) && $_GET['search'] != ''){
            $search_str = $_GET['search'];
            $user_options = array();
                if(isset($_GET['uall'])){
                    $_GET['ostu'] = 'Students';
                    $_GET['olec'] = 'Lecturers';
                }
                if(isset($_GET['ostu'])) array_push($user_options, $_GET['ostu']);
                if(isset($_GET['olec'])) array_push($user_options, $_GET['olec']);
            $project_options = array();
                if(isset($_GET['pall'])){
                    $_GET['oid'] = 'Idea';
                    $_GET['ores'] = 'Research';
                    $_GET['oprj'] = 'Project';
                    $_GET['osrp'] = 'Senior Project';
                }
                if(isset($_GET['oid'])) array_push($project_options, $_GET['oid']);
                if(isset($_GET['ores'])) array_push($project_options, $_GET['ores']);
                if(isset($_GET['oprj'])) array_push($project_options, $_GET['oprj']);
                if(isset($_GET['osrp'])) array_push($project_options, $_GET['osrp']);
            $search = new Search($search_str, $user_options, $project_options);
            $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $search_manager = new SearchManager($database);
            $search_results = $search_manager->search($search);
            foreach ($search_results as $collection) {?>
            <ul class="col-md-offset-1 col-md-8">
                <h2><?=$collection->heading()?></h2><?php
                foreach ($collection->results() as $o){ ?>
                    <li><?=$o->adminView()?></li><?php } ?><hr>
            </ul><?php
            }
        }
        else echo '<h1 class="col-md-offset-1">No results</h1>';
    ?>
    </div>
</body>
<?php include "_pages/footer.php"; ?>
