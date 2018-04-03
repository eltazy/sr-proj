<?php
    if (!isset($_SESSION)) session_start();
	
	include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/TopicManager.class.php';

	include_once '_pages/header.php';

?>
<head>
	<title>Home</title>
</head>
<body>
		<div class="container-fluid">
			<div class="row">

				<!-- recent activity -->
				<div class="col-md-offset-1 col-md-8 offset-md-1">
					<h1>Recent Activity</h1>
					<?= include '_pages/recent_activity.php' ?>

				<!-- recently added projects -->
					<h1>Recent Projects</h1>
					<?php $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
					$latest_projects = IdeaAbstractionManager::getLatestProjects($database);
					// displaying latest projects
					foreach ($latest_projects as $project){
						$Constructor = str_replace(' ', '', $project['type']);
						echo new $Constructor($project).'<hr>';
					}?>
				</div>

				<!-- popular topics -->
				<div class="col-xs-12 col-md-3" id="popular-topics">
					<h3>Popular Topics</h3>
					<?php $popular_topics = TopicManager::getPopularTopics($database);
					// displaying topics
					echo '<ul>';
					foreach ($popular_topics as $topic)
						echo '<li>'.new Topic($topic).'</li>';
					echo '<li><a href="http://localhost/sr-proj/topic.php?all">All topics</a></li>';
					echo '</ul>';
					?>
				</div>
			</div>
		</div>
<?php 
	include_once '_pages/footer.php';
	?>
</body>