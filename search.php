<?php 
	include_once '_class/SearchManager.class.php';
?>
<!-- TODO: (Javascript) auto-enable all checkboxes when All option is selected -->
<!-- and disable when one option is disabled -->
<form action="search.php" method="post">
    <input type="text" name="search_input" placeholder="Search">
    <button type="submit" name="search">Search</button></br>
    <input type="checkbox" name="search_all" value="all" checked="checked">All
    <input type="checkbox" name="search_users" value="users">Users
    <input type="checkbox" name="search_srproj" value="srproject">Senior Projects
    <input type="checkbox" name="search_projects" value="project">Projects
    <input type="checkbox" name="search_research" value="research">Researches
    <input type="checkbox" name="search_ideas" value="idea">Ideas</br>
</form>
<?php 
    if(isset($_POST['search_input'])){
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
        $search_manager = new SearchManager($database);
        $seach = new Search();
        $search_results = $search_manager->searchStudents();
    }
?>