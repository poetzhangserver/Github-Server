<?php
	if(!class_exists(PathManager)) {
		class PathManager {
			const EXTRANET_HOST="zhanghomeserver.ddnsfree.com";
			public static function hostURL() {
				return "https://".self::EXTRANET_HOST.":9443";
			}
			
		}
	}
?>