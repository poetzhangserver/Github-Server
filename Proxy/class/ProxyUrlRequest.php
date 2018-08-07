<?php
	require_once(dirname(__FILE__)."/../../PathManager/PathManager.php");
	PathManager::importUrlLibrary();
	if(!class_exists(ProxyUrlRequest)){
		
		class ProxyUrlRequest extends UrlRequest {
		
			protected $_data;
		
			public function __construct($data) {
				$this->_data=$data;
				parent::__construct($data["url"]);
				if($data["header"]) {
					foreach($data["header"] as $key=>$value) {
						$this->addRequestHeaderValue($key, $value);
					}
				}
				if($data["get"]) {
					foreach($data["get"] as $key=>$value) {
						$this->addGetKeyValue($key, $value);
					}
				}
				if($data["post"]) {
					if(is_array($data["post"])) {
						foreach($data["post"] as $key=>$value) {
							$this->addPostKeyValue($key, $value);
						}
					} else {
						$this->appendPostString($data["post"]);
					}
				}
			}
		
			public static function requestWithData($data) {
				if($data&&$data["url"]) {
					$request=new ProxyUrlRequest($data);
					return $request;
				} else {
					return null;
				}
			}
			
			public function responseStringWithEncoding() {
				$encoding=$this->_data["encoding"];
				$string=$this->responseString();
				if(!$encoding) {
					$encoding=mb_detect_encoding($string, "UTF-8, BIG-5, GBK, GB2312");
				}
				if($encoding&&$encoding!="UTF-8") {
					return mb_convert_encoding($string, "UTF-8", $encoding);
				} else {
					return $string;
				}
			}
		}
	}
?>