<?php
	if(!class_exists(PathManager)) {
		class PathManager {
			const EXTRANET_HOST="zhanghomeserver.ddnsfree.com";
			public static function baseURL() {
				$host=self::EXTRANET_HOST;
				return "https://".$host.":9443/~Zhang";
			}
			
			public static function homeURL() {
				return self::baseURL()."/Home";
			}
			
			public static function libraryPath() {
				return dirname(__FILE__)."/../Library";
			}
			
			public static function urlLibraryPath($type="PHP") {
				return self::libraryPath()."/Urllib V2/".$type;
			}
			public static function importUrlLibrary($type="PHP") {
				if($type=="PHP") {
					require_once(self::urlLibraryPath()."/UrlRequest.php");
				}
			}
			
		}
	}
?>