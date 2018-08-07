<?php
	require_once("../class/ProxyUrlRequest.php");
	$data=json_decode($_POST["data"], true);
	$request=ProxyUrlRequest::requestWithData($data);
	if($request) {
		$request->startSynchronous();
		echo($request->responseStringWithEncoding());
	}	
?>