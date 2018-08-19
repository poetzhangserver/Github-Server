<?php
	if(!$serverdb) {
		if(!class_exists(MySQLDatabaseManager)) {
			require_once('MySQLDatabaseManager.php');
		}
		$serverdb=new MySQLDatabaseManager('localhost', '385792', 'guestdb');
	}

?>