function loadjs(js){
    eval(getjsfile(js+'?'));
}

function hb(){
    var now=new Date(); 
    var hb=now.getTime();
    return hb;
}

function getjsfile(jsfile) {
    if (jsfile==null) return;
    var data = "";
    var method = "GET";
	var rq=xmlHTTPRequestObject();
	rq.open(method, jsfile+'&hb='+hb(),false);
	rq.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
	rq.send(data);
	return rq.responseText;
}

function xmlHTTPRequestObject() {
	var obj = false;
	var objs = ["Microsoft.XMLHTTP","Msxml2.XMLHTTP","MSXML2.XMLHTTP.3.0","MSXML2.XMLHTTP.4.0"];
	var success = false;
	for (var i=0; !success && i < objs.length; i++) {
		try {
			obj = new ActiveXObject(objs[i]);
			success = true;
		} catch (e) { obj = false; }
	}

	if (!obj) obj = new XMLHttpRequest();
	return obj;
}
