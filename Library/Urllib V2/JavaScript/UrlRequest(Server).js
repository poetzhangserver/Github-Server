UrlRequest.prototype.responseStringWithoutAdvertisement=function() {
	var responseString=this.responseString();
	var index=responseString.lastIndexOf("\n<!-- Free Web Hosting Area Start -->");
	if(index!=-1) {
		responseString=responseString.substring(0, index);
	}
	return responseString;
}