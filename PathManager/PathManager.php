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
			
			protected static $_libraryPathArray=array();
			protected static function importJavaScriptLibrary($path) {
				$key="js;path;".$path;
				if(!in_array($key, self::$_libraryPathArray)) {
					array_push(self::$_libraryPathArray, $key);
					echo("<script type='text/javascript'>\n");
					echo(file_get_contents($path));
					echo("\n</script>\n");
				}
				
			}
			
			public static function utilityLibraryPath($type="PHP") {
				return self::libraryPath()."/Utility V2/".$type;
			}
			public static function importUtilityLibrary($type="PHP") {
				if($type=="PHP") {
					
				} else {
					self::importJavaScriptLibrary(self::utilityLibraryPath($type)."/Utility.js");
				}
			}
			
			
			public static function urlLibraryPath($type="PHP") {
				return self::libraryPath()."/Urllib V2/".$type;
			}
			public static function importUrlLibrary($type="PHP") {
				if($type=="PHP") {
					require_once(self::urlLibraryPath()."/UrlRequest.php");
				} else {
					self::importUtilityLibrary($type);
					self::importJavaScriptLibrary(self::urlLibraryPath($type)."/UrlRequest.js");
					self::importJavaScriptLibrary(self::urlLibraryPath($type)."/UrlRequest(Server).js");
				}
			}
			
			public static function encodingLibraryPath() {
				return self::libraryPath()."/Encoding V2";
			}
			
			public static function databaseLibraryPath() {
				return self::encodingLibraryPath()."/Database/PHP";
			}
			public static function importDatabaseLibrary() {
				require_once(self::databaseLibraryPath()."/SQLStatement.php");
				require_once(self::databaseLibraryPath()."/DatabaseManager.php");
				require_once(self::databaseLibraryPath()."/SQLiteDatabaseManager.php");
			}
			
		}
	}
?>