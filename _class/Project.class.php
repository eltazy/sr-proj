<?php
////////////////script start
include_once 'IdeaAbstraction.class.php'

class Project extends IdeaAbstraction{
    private $_original_idea_id; //ID of the idea from which the Project may have originated

    private static $_project_count = 0;
}
////////////////script end
?>