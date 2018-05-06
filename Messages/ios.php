<?php

	require_once(dirname(__FILE__)."/../PathManager/PathManager.php");
	PathManager::importUrlLibrary();
	$request=UrlRequest::requestWithUrlString(PathManager::homeURL()."/Messages/ios.php");
	$request->setPostString(file_get_contents("php://input"));
	$request->startSynchronous();
	echo($request->responseString());
	
?>