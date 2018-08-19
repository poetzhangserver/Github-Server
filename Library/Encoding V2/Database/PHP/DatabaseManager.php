<?php
	
	if(!class_exists(DatabaseManager)) {
		
		//require_once('SQLStatement.php');
		date_default_timezone_set('Asia/Shanghai');
		class DatabaseManager {
		
			protected $_db;
			
			public function __construct($dsn, $account=NULL, $password=NULL) {
				$this->_db=new PDO($dsn, $account, $password);
			}
			
			public function prepareStatementForSQL($sql) {
				return new SQLStatement($this->_db, $sql);
			}
		}
	}
?>