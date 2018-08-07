<?php
	require_once(dirname(__FILE__)."/../class/ProxyUrlRequest.php");
	$data=json_decode($_POST["data"], true);
	$result=array();
	$request=ProxyUrlRequest::requestWithData($data);
	if($request) {
		$request->startSynchronous();
		$result["responseString"]=$request->responseStringWithEncoding();
		$result["responseInfo"]=$request->responseInfo();
		$result["responseError"]=$request->responseError();
	}
	
	echo(json_encode($result, JSON_UNESCAPED_UNICODE));
	
	
?>