<?php
	if(!class_exists(UrlRequest)){
		
		class UrlRequest {
			protected $_urlString;
			protected $_timeoutSeconds=20;
			protected $_getValueDictionary=array();
			protected $_postValueDictionary=array();
			protected $_postData;
			protected $_requestHeaders=array();
			
			protected $_responseHeader;
			protected $_responseData;
			protected $_responseInfo;
			protected $_responseError;
			
			public function __construct($urlString) {
				$this->_urlString=$urlString;
			}
			
			public function setTimeOutSeconds($seconds) {
				$this->_timeoutSeconds=$seconds;
			}
			
			public function addGetKeyValue($key, $value) {
				$this->_getValueDictionary[$key]=$value;
			}
			public function addPostKeyValue($key, $value) {
				$this->_postValueDictionary[$key]=$value;
			}
			public function setPostString($data) {
				$this->_postData=$data;
			}
			public function appendPostString($data) {
				$this->setPostString($data);
			}
			public function addRequestHeaderValue($header, $value) {
				$this->_requestHeaders[$header]=$value;
			}
			
			public function startSynchronous() {
				$ch=curl_init();
				$getData="";
				curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeoutSeconds);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->_timeoutSeconds);
				foreach($this->_getValueDictionary as $key=>$value) {
					$getData.="&".rawurlencode($key)."=".rawurlencode($value);
				}
				if(strlen($getData)) {
					$getData="?".substr($getData, 1);
				}
				if(($this->_postData==null)&&(count($this->_postValueDictionary))) {
					$this->_postData="";
					foreach($this->_postValueDictionary as $key=>$value) {
						$this->_postData.="&".rawurlencode($key)."=".rawurlencode($value);
					}
					$this->_postData=substr($this->_postData, 1);
				}
				curl_setopt($ch, CURLOPT_URL, $this->_urlString.$getData);
				if($this->_postData) {
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_postData);
				}
				if(count($this->_requestHeaders)) {
					curl_setopt($ch, CURLOPT_HEADER, true);
					$headers=array();
					foreach($this->_requestHeaders as $key=>$value) {
						array_push($headers, $key.": ".$value);
					}
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				}
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_HEADER, true);
				
				$this->_responseInfo=curl_getinfo($ch);
				$this->_responseError=curl_errno($ch);
				$response=curl_exec($ch);
				if(curl_getinfo($ch, CURLINFO_HTTP_CODE)=='200') {
					$headerSize=curl_getinfo($ch, CURLINFO_HEADER_SIZE);
					$this->_responseHeader=substr($response, 0, $headerSize);
					$this->_responseData=substr($response, $headerSize);
				} else {
					$this->_responseData=$response;
				}
				curl_close($ch);
			}
			
			public function responseString() {
				return $this->_responseData;
			}
			public function responseInfo() {
				return $this->_responseInfo;
			}
			public function responseHeader() {
				return $this->_responseHeader;
			}
			public function responseStatusCode() {
				return $this->_responseInfo['http_code'];
			}
			public function responseError() {
				return $this->_responseError;
			}
			public static function requestWithUrlString($urlString) {
				return new UrlRequest($urlString);
			}
		}
	}
?>