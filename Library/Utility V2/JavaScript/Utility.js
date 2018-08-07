function Utility() {
}

Utility.extendClassFromClass=function(ChildClass, ParentClass) {
	var func=function(){};
	func.prototype=ParentClass.prototype;
	ChildClass.prototype=new func();
	ChildClass.prototype.constructor=ChildClass;
	
	for(var i in ParentClass) {
		ChildClass[i]=ParentClass[i];
	}
	ChildClass.super=ParentClass.prototype;
}

Utility.UUID=function() {
	function randomDigit() {
		if(crypto&&crypto.getRandomValues) {
			var rands=new Uint8Array(1);
			crypto.getRandomValues(rands);
			return (rands[0]%16).toString(16);
        } else {
            return ((Math.random()*16)|0).toString(16);
        }
    }
    var crypto=window.crypto||window.msCrypto;
    return 'xxxxxxxx-xxxx-4xxx-8xxx-xxxxxxxxxxxx'.replace(/x/g, randomDigit);
}

Utility.deviceID=function() {
	if(store&&store.enabled) {
		var udid=store.get('udid');
		if(!udid) {
			udid=this.UUID();
			store.set('udid', udid);
		}
		return 'broswer_'+udid;
	} else {
		return 'broswer_unknown';
	}
}

//參考http://blog.phpdr.net/js-get-image-size.html
Utility.loadImageCompletion=(function() {
	var stacks=[], intervalId=null;
	var onTimer=function() {
		for(var i=0; i<stacks.length; i++) {
			stacks[i].ready?stacks.splice(i--, 1):stacks[i]();
		};
		if(!stacks.length) {
			clearInterval(intervalId);
			intervalId = null;
		}
	}
	return function(url, completion) {
		var image=new Image();
		image.src=url;
		if(image.complete) {
			if(completion) {
				completion(image);
			}
			return;
		}
		var width=image.width, height=image.height;
		image.onerror=function() {
			onready.ready=true;
			image=image.onload=image.onerror=null;
		};
		
		var onready=function() {
			var newWidth=image.width, newHeight=image.height;
			if(newWidth!==width||newHeight!==height||newWidth*newHeight>1024) {
				if(completion) {
					completion(image);
				}
				onready.ready=true;
			};
		};
		onready();
		
		image.onload=function() {
			if(!onready.ready) {
				onready();
			}
			image=image.onload=image.onerror=null;
		};
		if(!onready.ready) {
			stacks.push(onready);
			if(intervalId===null) {
				intervalId=setInterval(onTimer, 40);
			}
		}

		
	};

})();

function NSObject() {
}

NSObject.prototype.className=function() {
	return this.constructor.name;
}

// angularJs

if((typeof location!=="undefined")&&!location.get) {
	location.get=(function() {
		function tryDecodeURIComponent(value) {
			try {
				return decodeURIComponent(value);
			} catch (e) {
				
			}
		}
		function isDefined(value) {
			return typeof value!=='undefined';
		}
		function parseKeyValue(keyValue) {
			keyValue=keyValue.replace(/^\?/, '');
			var obj={}, key_value, key;
			var iter=(keyValue||"").split('&');
			for(var i=0; i<iter.length; i++) {
			    var kValue=iter[i];
			    if(kValue) {
			    	key_value=kValue.replace(/\+/g,'%20').split('=');
			    	key=tryDecodeURIComponent(key_value[0]);
			    	if(isDefined(key)) {
			    		var val=isDefined(key_value[1])?tryDecodeURIComponent(key_value[1]):true;
						if(!hasOwnProperty.call(obj, key)) {
							obj[key]=val;
						} else if(isArray(obj[key])) {
							obj[key].push(val);
						} else {
							obj[key]=[obj[key],val];
						}
					}
				}
			}
			return obj;
		}
		return function(arg) {
			var q=parseKeyValue(this.search);
			if(!isDefined(arg)) {
				return q;
			}
			if(q.hasOwnProperty(arg)) {
				return q[arg];
			} else {
				return null;
			}
		};
	})();
}

if(typeof window!=="undefined") {
	window.openWithPostData=function(url, data, name) {
		var form=document.createElement("form");
		form.method="post";
		form.action=url;
		if(name) {
			form.target=name;//"_blank";
		}
		
		var input=document.createElement("input");
		input.type="hidden";
		input.name="data";
		input.value=data;
		form.appendChild(input);
		form.setAttribute("onsubmit", "window.open();");
		
		document.body.appendChild(form);
		form.submit();
		document.body.removeChild(form);
	}
}

if(!String.prototype.trim) {
	String.prototype.trim=function() {
    	return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
	};
}

String.prototype.urlEncodedString=function() {
	return encodeURIComponent(this).replace(/'/g, "%27");
};

String.prototype.urlDecodedString=function() {
	return decodeURIComponent(this);
};

String.prototype.hasSuffix=function(suffix) {
    return this.indexOf(suffix, this.length-suffix.length)!==-1;
};

String.prototype.hasPreffix=function(preffix) {
    return this.indexOf(preffix, 0)===0;
};

String.prototype.pathExtension=function() {
	return this.split('.').pop();
}

String.prototype.intValue=function() {
	return parseInt(this);
}

String.prototype.floatValue=function() {
	return parseFloat(this);
}

String.prototype.escapedHtmlString=function() {
	return this.replace(/&/g, '&amp;').replace(/>/g, '&gt;').replace(/</g, '&lt;').replace(/"/g, '&quot;').replace(/'/g, '&apos;');
}