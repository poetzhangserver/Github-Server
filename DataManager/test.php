<?php
	require_once(dirname(__FILE__)."/../PathManager/PathManager.php");
	PathManager::importDatabaseLibrary();
	echo "import success;";
	$db=new MySQLDatabaseManager();
	echo "new mysql;";
	$statement=$db->prepareStatementForSQL("insert or replace into data (id, type, token, data, delete_token, timestamp) values (?, ?, ?, ?, ?, ?)");
	echo "prepare finish;";
	$statement->setParameterAtIndexAsObject(0, "id");
	$statement->setParameterAtIndexAsObject(1, "type");
	$statement->setParameterAtIndexAsObject(2, "token");
	$statement->setParameterAtIndexAsObject(3, "data");
	$statement->setParameterAtIndexAsObject(4, "delete_token");
	$statement->setParameterAtIndexAsCurrentDate(5);
	$statement->execute();
	echo "finish;";

?>