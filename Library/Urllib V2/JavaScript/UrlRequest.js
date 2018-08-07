function UrlRequest(urlString) {
	if(XMLHttpRequest) {
		this._request=new XMLHttpRequest();
	} else if(window.ActiveXObject) {// code for IE5 and IE6
		try {
			this._request=new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			try {
				this._request=new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e2) {
				this._request=false;
			}
		}
	}
	this._urlString=urlString;
	
	this._getValueDictionary={};
	this._postValueDictionary={};
	
	this._postData=null;
	
}

UrlRequest.prototype.setCompletion=function(callback) {
	this._completion=callback;
}

UrlRequest.prototype.addGetKeyValue=function(key, value) {
	this._getValueDictionary[key]=value;
}
UrlRequest.prototype.addPostKeyValue=function(key, value) {
	this._postValueDictionary[key]=value;
}
UrlRequest.prototype.setPostString=function(data) {
	this._postData=data;
}
UrlRequest.prototype.appendPostString=function(data) {
	this.setPostString(data);
}

UrlRequest.prototype.addRequestHeaderValue=function(header, value) {
	this._request.setRequestHeader(header, value);
}

UrlRequest.prototype.readyState=function() {
	return this._request.readyState;
}
UrlRequest.prototype.responseStatusCode=function() {
	return this._request.status;
}
UrlRequest.prototype.responseString=function() {
	return this._request.responseText;
}
UrlRequest.prototype.responseXML=function() {
	return this._request.responseXML;
}

UrlRequest.prototype.startAsynchronous=function() {
	var getData="";
	for(var key in this._getValueDictionary) {
		getData+="&"+key.urlEncodedString()+"="+this._getValueDictionary[key].urlEncodedString();
	}
	if(getData.length) {
		getData="?"+getData.substring(1);
	}
	if(this._postData==null&&Object.keys(this._postValueDictionary).length) {
		this._postData="";
		for(var key in this._postValueDictionary) {
			this._postData+="&"+key.urlEncodedString()+"="+this._postValueDictionary[key].urlEncodedString();
		}
		
		this._postData=this._postData.substring(1);
	}
	if(this._postData==null) {
		this._request.open("GET", this._urlString+getData, true);
	} else {
		this._request.open("POST", this._urlString+getData, true);
		this._request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	}
	var self=this;
	this._request.onreadystatechange=function() {
		if(self._request.readyState==4) {
			if(self._completion) {
				self._completion(self);
			}
		}
	}
	this._request.send(this._postData);
	
}


UrlRequest.requestWithUrlString=function(urlString) {
	return new UrlRequest(urlString);
}


