<?php
	require_once("../class/ProxyUrlRequest.php");
	require_once("../../Library/HTMLParser/simple_html_dom.php");
	$data=array("url"=>"http://www.google.com.tw", "encoding"=>"BIG-5");
	if($_GET["q"]) {
		$data["url"].="/search";
		$gets=array();
		foreach($_GET as $key=>$value) {
			if($key!="ie") {
				$gets[$key]=$value;
			}
		}
		$data["get"]=$gets;
	} elseif($_GET["path"]) {
		$data["url"].=htmlspecialchars_decode($_GET["path"]);
	}
	$request=ProxyUrlRequest::requestWithData($data);
	if($request) {
		$request->startSynchronous();
		$html=str_get_html($request->responseStringWithEncoding());
		foreach($html->find('a') as $element) {
			$href=$element->href;
			if(strpos($href, "/url?q=")===0) {
				$href=substr($href, strlen("/url?q="));
				$pos=strpos($href, "&");
				if($pos) {
					$href=substr($href, 0, $pos);
				}
				$element->href=$href;
			} elseif(strpos($href, "/")===0) {
				$element->href=$_SERVER["PHP_SELF"]."?path=".rawurlencode($href);
			}
			
		}
		foreach($html->find('form') as $element) {
			$element->action=$_SERVER["PHP_SELF"];
		}
		echo($html);
	}
	
?>