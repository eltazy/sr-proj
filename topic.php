<?php
    include_once '_class/TopicManager.class.php';
    include_once '_class/IdeaAbstractionManager.class.php';

	include '_pages/header.php'; ?>
<body>
    <div class="container-fluid" id="pagecontent">
        <?php
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
        if(isset($_GET['title'])){
            echo '<title>Topic: '.$_GET['title'].'</title>';
            $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');

            $topic_manager = new TopicManager($database);
            $topic = $topic_manager->get($_GET['title']);
            $hits = $topic->hits()?>
            
        <div class="col-md-offset-2 col-md-8">
            <h1><?=$hits?> <?=$hits==1?'project':'projects'?> discussing this topic</h1><hr><?php
            $projects = explode(';', $topic->projects());
            $project_manager = new IdeaAbstractionManager($database);
            foreach ($projects as $projID)
                if(!empty($projID)) echo $project_manager->get($projID);
        }else{?>
            <h1></h1>
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
                </form>
            </div>
            <?php
                if(isset($_GET['search'])){
                    echo '<title>Search for topics like '.$_GET['search'].'</title>';
                    $search_results = TopicManager::searchTopics($_GET['search'], $database);
                    echo '<ul>';
                    foreach ($search_results as $topic)
                        echo '<li class="col-md-offset-2 col-md-6">'.(new Topic($topic)).'</li>';
                    echo '</ul>';
                }else{
            echo '<title>All Topics</title>';
            $all_topics = TopicManager::getTopics($database);?>
            <div class="col-md-offset-2 col-md-6">
                <h1>All Topics</h1><?php
            foreach ($all_topics as $topic)
                echo '<li>'.new Topic($topic).'</li>';}
        }
        ?>
        </div>
    </div>
    <?php include_once '_pages/footer.php';?>
</body>