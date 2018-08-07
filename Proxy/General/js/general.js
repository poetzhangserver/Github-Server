function addGet() {
	var getview=document.getElementById("getview");
	var getcell=document.createElement("div");
	var input=document.createElement("input");
	input.type="text";
	input.setAttribute("placeholder", "key");
	getcell.appendChild(input);
	input=document.createElement("input");
	input.type="text";
	input.setAttribute("placeholder", "value");
	getcell.appendChild(input);
	getview.appendChild(getcell);
}

function addPost() {
	var postview=document.getElementById("postkeyvalueview");
	var postcell=document.createElement("div");
	var input=document.createElement("input");
	input.type="text";
	input.setAttribute("placeholder", "key");
	postcell.appendChild(input);
	input=document.createElement("input");
	input.type="text";
	input.setAttribute("placeholder", "value");
	postcell.appendChild(input);
	postview.appendChild(postcell);
}

function changePostView() {
	if(document.getElementById("postkeyvalueview").style.display=="") {
		document.getElementById("postkeyvalueview").style.display="none";
		document.getElementById("posttextview").style.display="";
		document.getElementById("addPostButton").style.display="none";
	} else {
		document.getElementById("postkeyvalueview").style.display="";
		document.getElementById("posttextview").style.display="none";
		document.getElementById("addPostButton").style.display="";
	}
}
function addHeader() {
	var headerview=document.getElementById("headerview");
	var headercell=document.createElement("div");
	var input=document.createElement("input");
	input.type="text";
	input.setAttribute("placeholder", "key");
	headercell.appendChild(input);
	input=document.createElement("input");
	input.type="text";
	input.setAttribute("placeholder", "value");
	headercell.appendChild(input);
	headerview.appendChild(headercell);
}
function data() {
	var dict={};
	
	var urlview=document.getElementById("urlview");
	if(urlview.getElementsByTagName("input")[0].value) {
		dict["url"]=urlview.getElementsByTagName("input")[0].value;
	}
	
	var getview=document.getElementById("getview");
	var inputs=getview.getElementsByTagName("div");
	var getDict={};
	if(inputs.length) {
		for(var i=0;i<inputs.length;i++) {
			var fields=inputs[i].getElementsByTagName("input");
			if(fields.length==2&&fields[0].value!='') {
				getDict[fields[0].value]=fields[1].value;
			}
		}
		dict["get"]=getDict;
	}
	
	
	if(document.getElementById("postkeyvalueview").style.display=="") {
		var postview=document.getElementById("postkeyvalueview");
		inputs=postview.getElementsByTagName("div");
		var postDict={};
		if(inputs.length) {
			for(var i=0;i<inputs.length;i++) {
				var fields=inputs[i].getElementsByTagName("input");
				if(fields.length==2&&fields[0].value!='') {
					postDict[fields[0].value]=fields[1].value;
				}
			}
			dict["post"]=postDict;
		}
	} else {
		var postview=document.getElementById("posttextview");
		if(postview.getElementsByTagName("textarea")[0].value) {
			dict["post"]=postview.getElementsByTagName("textarea")[0].value;
		}
		
	}
	
	var headerview=document.getElementById("headerview");
	var inputs=headerview.getElementsByTagName("div");
	var headerDict={};
	if(inputs.length) {
		for(var i=0;i<inputs.length;i++) {
			var fields=inputs[i].getElementsByTagName("input");
			if(fields.length==2&&fields[0].value!='') {
				headerDict[fields[0].value]=fields[1].value;
			}
		}
		dict["header"]=headerDict;
	}
	
	var encodingview=document.getElementById("encodingview");
	if(encodingview.getElementsByTagName("input")[0].value) {
		dict["encoding"]=encodingview.getElementsByTagName("input")[0].value;
	}
	
	return dict;
}
function showSource() {
	var dict=data();
	if(dict["url"]) {
		var request=UrlRequest.requestWithUrlString("general.json.php");
		request.addPostKeyValue("data", JSON.stringify(dict));
		//var self=this;
		request.setCompletion(function(request) {
			
			if(request.responseStatusCode()==200) {
				var dict=JSON.parse(request.responseStringWithoutAdvertisement());
				
				document.getElementById("responseview").textContent=JSON.stringify(dict["responseInfo"]);
				if(dict["responseError"]) {
					document.getElementById("responseview").textContent+="<br />"+JSON.stringify(dict["responseError"]);
				}
				document.getElementById("sourcecodeview").textContent=JSON.stringify(dict["responseString"]);
				document.getElementById("frameview").style.display="none";
				document.getElementById("sourcecodeview").style.display="";
			}
			
		});
		request.startAsynchronous();
	} else {
		alert("url cannot be empty");
	}
	
}
function showInFrame() {
	var dict=data();
	if(dict["url"]) {
		window.openWithPostData(location.href.substring(0, location.href.lastIndexOf("/"))+"/general.html.php", JSON.stringify(dict), 'frame');
		document.getElementById("frameview").style.display="";
		document.getElementById("sourcecodeview").style.display="none";
	} else {
		alert("url cannot be empty");
	}
}
function showInWindow() {
	var dict=data();
	if(dict["url"]) {
		window.openWithPostData(location.href.substring(0, location.href.lastIndexOf("/"))+"/general.html.php", JSON.stringify(dict), '_blank');
	} else {
		alert("url cannot be empty");
	}
}