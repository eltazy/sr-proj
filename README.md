# sr-proj
* Install wamp/lamp/mamp server;
* Download then install test mail server at http://www.toolheap.com/test-mail-server-tool/ for email simulation;
* Set to go, open index.php in web browser
* create for databases
* CREATE TABLE `lecturers_tb` (`firstname` tinytext NOT NULL, `middlename` tinytext NOT NULL, `lastname` tinytext NOT NULL, `gender` tinytext NOT NULL, `username` tinytext NOT NULL, `email` tinytext NOT NULL, `supervision` tinyint(1) DEFAULT NULL, `hasprojects` tinyint(1) DEFAULT NULL, `hasideas` tinyint(1) DEFAULT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1
* CREATE TABLE `students_tb` (`firstname` tinytext NOT NULL, `middlename` tinytext, `lastname` tinytext NOT NULL, `gender` tinytext NOT NULL, `username` tinytext NOT NULL, `email` tinytext NOT NULL, `schoolid` tinytext, `major` tinytext, `hasprojects` tinyint(1) DEFAULT NULL, `hasideas` tinyint(1) DEFAULT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1
* CREATE TABLE `temp_lecturers_tb` (`firstname` tinytext NOT NULL, `middlename` tinytext, `lastname` tinytext NOT NULL, `gender` tinytext NOT NULL, `username` tinytext NOT NULL, `email` tinytext NOT NULL, `supervision` tinyint(1) DEFAULT NULL, `hasprojects` tinyint(1) DEFAULT NULL, `hasideas` tinyint(1) DEFAULT NULL, `uniqueid` tinytext NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1
* CREATE TABLE `temp_students_tb` (`firstname` tinytext NOT NULL, `middlename` tinytext, `lastname` tinytext NOT NULL, `gender` tinytext NOT NULL, `username` tinytext NOT NULL, `email` tinytext NOT NULL, `schoolid` tinytext, `major` tinytext, `hasprojects` tinyint(1) DEFAULT NULL, `hasideas` tinyint(1) DEFAULT NULL, `uniqueid` tinytext NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1
* CREATE TABLE `temp_user_pwd` (`username` tinytext NOT NULL, `known_password` tinytext NOT NULL, `uniqueid` tinytext NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1
* CREATE TABLE `user_pwd` (`username` tinytext NOT NULL, `known_password` tinytext NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1
