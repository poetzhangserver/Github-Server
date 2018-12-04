<?php

	require_once(dirname(__FILE__)."/../PathManager/PathManager.php");
	PathManager::importUrlLibrary();
	if($_GET["hostname"]&&$_GET["ip"]&&$_GET["username"]&&$_GET["password"]) {
		$request=UrlRequest::requestWithUrlString("https://api.dynu.com/nic/update?hostname=".$_GET["hostname"]."&myip=".$_GET["ip"]."&username=".$_GET["username"]."&password=".$_GET["password"]);
		$request->startSynchronous();
		echo($request->responseString());
	}
	
	
?>