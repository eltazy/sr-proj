<?php
    include_once '_class/TopicManager.class.php';
    include_once '_class/IdeaAbstractionManager.class.php';

	include '_pages/header.php'; ?>
<body>
    <div class="container-fluid">
        <?php
        $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
        if(isset($_GET['title'])){
            $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');

            $topic_manager = new TopicManager($database);
            $topic = $topic_manager->get($_GET['title']);
            echo $topic->hits().' projects discussing this topic';
            $projects = explode(';', $topic->projects());
            $project_manager = new IdeaAbstractionManager($database);
            foreach ($projects as $projID)
                echo $project_manager->get($projID);
        }else{
            $all_topics = TopicManager::getTopics($database);
            foreach ($all_topics as $topic)
                echo '<div class="row"><div class="col-md-offset-2">'.new Topic($topic).'</div></div>';
        }
        ?>
    </div>
    <?php include_once '_pages/footer.php';?>
</body>