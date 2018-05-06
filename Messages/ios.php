<?php

	require_once(dirname(__FILE__)."/../PathManager/PathManager.php");
	header("location: ".PathManager::hostURL());
	exit;

?>