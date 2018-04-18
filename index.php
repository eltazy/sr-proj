<?php
    if (!isset($_SESSION)) session_start();
	
	include_once '_class/IdeaAbstractionManager.class.php';
	include_once '_class/TopicManager.class.php';

	include_once '_pages/header.php';

?>
<title>Home</title>
<body>
	<div class="container-fluid" id="pagecontent">
			<div class="col-md-offset-1 col-md-8 offset-md-1">
				<!-- recent activity -->
				<!-- <h1>Recent Activity</h1>
				<?php include '_pages/recent_activity.php' ?> -->

				<!-- recent projects -->
				<h1>Recent Projects</h1>
				<?php $database = new PDO('mysql:host=localhost;dbname=srproj', 'root', '');
				$latest_projects = IdeaAbstractionManager::getLatestProjects($database);
				foreach ($latest_projects as $project){
					$Constructor = str_replace(' ', '', $project['type']);
					echo new $Constructor($project);
				}?>
			</div>

			<div class="col-xs-12 col-md-3" id="popular-topics">
				<!-- popular topics -->
				<h3>Popular Topics</h3>
				<?php $popular_topics = TopicManager::getPopularTopics($database) ?>
				<li><a href="http://localhost/sr-proj/topic.php?all">All topics</a></li>
				<ul><?php
				foreach ($popular_topics as $topic)
					echo '<li>'.new Topic($topic).'</li>';
				?>
				</ul>
			</div>
	</div>
</body>
<?php include_once '_pages/footer.php';
