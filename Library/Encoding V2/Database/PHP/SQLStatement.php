<?php
	if(!class_exists(SQLStatement)) {
		
		class SQLStatement {
		
			protected $_db;
			
			protected $_statement;
			
			public function __construct($database, $sql) {
				$this->_db=$database;
				$this->_statement=$this->_db->prepare($sql);
			}
			
			public function setParameterAtIndexAsObject($index, $value) {
				$this->_statement->bindParam($index+1, $value);
			}
			
			public function setParameterAtIndexAsCurrentDate($index) {
				$this->setParameterAtIndexAsObject($index, date('Y-m-d H:i:s'));
			}
			
			public function execute() {
				$this->_statement->execute();
			}
			
			public function fetchRecords() {
				return $this->_statement->fetchAll();
			}
			
			public function fetchRecord() {
				return $this->_statement->fetch();
			}
			
			/*
			public function fetchIntRecord() {
				$row=$this->_stmt->fetch();
				return $row[0];
			}
*/
		
		}
		
	}
	
?>