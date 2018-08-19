<?php
	if(!class_exists(MySQLDatabaseManager)) {
		
		require_once('DatabaseManager.php');
		class MySQLDatabaseManager extends DatabaseManager {
		
			public function __construct($host='localhost', $dbname='data', $name='zhang', $password='JvLWQ8RpZ') {
				parent::__construct('mysql:host='.$host.';dbname='.$dbname, $name, $password);
				$this->_db->exec('set names utf8');
			}
			
		}
	}
?>