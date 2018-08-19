<?php
	if(!class_exists(SQLiteDatabaseManager)) {
		
		//require_once('DatabaseManager.php');
		class SQLiteDatabaseManager extends DatabaseManager {
		
			public function __construct($path) {
				parent::__construct('sqlite:'.$path);
			}
			
			public function lastID() {
				$statement=$this->prepareStatementForSQL("select last_insert_rowid()");
				$statement->execute();
				$row=$statement->fetchRecord();
				return $row[0];
			}
			
		}
	}
?>