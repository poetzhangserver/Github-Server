<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Proxy</title>
<script type="text/javascript" src="js/general.js"></script>
<?php
	require_once(dirname(__FILE__)."/../../PathManager/PathManager.php");
	PathManager::importUtilityLibrary("JavaScript");
	PathManager::importUrlLibrary("JavaScript");
?>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div id="navigationview">
	<div>
		<div>url</div>
		<div id="urlview"><input type="text" placeholder="http://" /></div>
	</div>
	<div>
		<div>
			<span>get</span>
			<button onclick="addGet();">Add Get</button>
		</div>
		<div id="getview">
			<div><input type="text" placeholder="key" /><input type="text" placeholder="value" /></div>
		</div>
	</div>
	<div>
		<div>
			<span>post</span>
			<button onclick="changePostView();">Change PostView</button>
			<button id="addPostButton" onclick="addPost();">Add Post</button>
		</div>
		<div id="postkeyvalueview">
			<div><input type="text" placeholder="key" /><input type="text" placeholder="value" /></div>
		</div>
		<div id="posttextview" style="display:none">
			<textarea rows="5"></textarea>
		</div>
	</div>
	<div>
		<div>
			<span>header</span>
			<button onclick="addHeader();">Add Header</button>
		</div>
		<div id="headerview">
			<div><input type="text" placeholder="key" /><input type="text" placeholder="value" /></div>
		</div>
	</div>
	<div>
		<div>encoding</div>
		<div id="encodingview"><input type="text" placeholder="UTF-8" /></div>
	</div>
	<div>
		<button onclick='showSource();'>Show Source</button>
		<button onclick="showInFrame();">Open in Frame</button>
		<button onclick="showInWindow();">Open in New Window</button>
	</div>
	<div id="responseview">
	</div>
</div>
<div id="contentview">
	<div id="sourcecodeview">
	</div>
	<iframe id="frameview" name="frame" style="display:none">
	</iframe>
</div>

</body>
</html>