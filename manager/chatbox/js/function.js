function addsmile(kitu){
	window.opener.document.chatform.uptext.value = opener.document.chatform.uptext.value + kitu;
}

function upstyle_chat(element){
	if (element == 'b')
	{
		if (document.getElementById('upb').className == 'btn btnChat')
			document.getElementById('upb').className = 'btn btn-primary btnChat';
		else
			document.getElementById('upb').className = 'btn btnChat';
		
	}
	else if (element == 'i')
	{
		if (document.getElementById('upi').className == 'btn btnChat')
			document.getElementById('upi').className = 'btn btn-primary btnChat';
		else
			document.getElementById('upi').className = 'btn btnChat';
		
	}
	else if (element == 'u')
	{
		if (document.getElementById('upu').className == 'btn btnChat')
			document.getElementById('upu').className = 'btn btn-primary btnChat';
		else
			document.getElementById('upu').className = 'btn btnChat';	
	}
}
function check_form()
{
	if(document.getElementById('uptext').value == "")
	{
		alert("Bạn chưa nhập nội dung chat");
		document.getElementById('uptext').focus();
	}
	if(document.getElementById('uptext').value.length>255)
	{
		alert("Nội dung ko được dài quá 255 ký tự");
		document.getElementById('uptext') = document.getElementById('uptext').substring(0,255);
		document.getElementById('uptext').focus();
	}
	else
	{
		send_chat();
	}
}

function smiliepopup(){
	window.open("./chatbox/index.php?param=smilies", "", "location=no,scrollbars=yes,width=500,height=500");
}

function send_chat(){
	var text = document.getElementById('uptext').value;
	var name = document.getElementById('name').value;
	var upcolor = document.getElementById('upcolor').value.toLowerCase();
	var upfont = document.getElementById('upfont').value;
	var upb = (document.getElementById('upb').className == 'btn btn-primary btnChat') ? 'B' : '';
	var upi = (document.getElementById('upi').className == 'btn btn-primary btnChat') ? 'I' : '';
	var upu = (document.getElementById('upu').className == 'btn btn-primary btnChat') ? 'U' : '';
	var ip = document.getElementById('ip').value;
	var param = 'name='+name+'&text='+text+'&upfont='+upfont+'&upcolor='+upcolor+'&upb='+upb+'&upi='+upi+'&upu='+upu+'&ip='+ip;				
	var ajax = new AJAX_Handler();
	ajax.onreadystatechange(send_chat_done);
	ajax.send("./chatbox/content.php",param);
	document.getElementById('uptext').value='';			
	function send_chat_done()
	{
		if(ajax.handler.readyState == 4 && ajax.handler.status == 200){
			document.getElementById('content_chat').innerHTML = ajax.handler.responseText;
		}
	}
	var objDiv = document.getElementById("main");
	//objDiv.scrollTop = objDiv.scrollHeight;
}
function reg_check(){
	var user = document.getElementById('username');
	var pass = document.getElementById('pass');
	var repass = document.getElementById('repass');
	if(user.value == "" || user.value.length<4){
		alert('Tên đăng nhập ko được để trống và phải lớn hơn 4 ký tự');
		user.focus();
		return false;
	}
	if(pass.value == "" || pass.value.length<=4){
		alert('Mật khẩu ko được để trống và phải lớn hơn 4 ký tự');	
		pass.focus();
		return false;
	}
	if(pass.value!=repass.value){
		alert('Hai ô mật khẩu ko giống nhau');
		pass.focus();
		return false;
	}
	else
		reg_submit(user.value,pass.value);
			
}
function reg_submit(user,pass){	
	var param = 'user='+user+'&pass='+pass;
	var ajax = new AJAX_Handler();
	ajax.onreadystatechange(send_reg_done);
	ajax.send("./chatbox/index.php?param=sign&act=up",param);	
	document.getElementById('main').innerHTML = 'Loading...';	
	function send_reg_done()
	{
		try{if(ajax.handler.readyState == 4 && ajax.handler.status == 200){
			document.getElementById('main').innerHTML = ajax.handler.responseText;
		}}catch(e){Ư}
	}
}
function log_check(){
	var user = document.getElementById('username').value;
	var pass = document.getElementById('pass').value;
	var param = 'user='+user+'&pass='+pass;
	var ajax = new AJAX_Handler();
	ajax.onreadystatechange(send_log_done);
	ajax.send("./chatbox/index.php?param=sign&act=in",param);	
	document.getElementById('main').innerHTML = 'Loading...';	
	function send_log_done()
	{
		if(ajax.handler.readyState == 4 && ajax.handler.status == 200){
			document.getElementById('main').innerHTML = ajax.handler.responseText;
		}
	}
}




var AJAX_Handler=function()
{this.xmlHttp=false;try{this.xmlHttp=new XMLHttpRequest();}catch(e){try{this.xmlHttp=new ActiveXObject('Microsoft.XMLHTTP');}catch(e){try{this.xmlHttp=new ActiveXObject('Msxml2.XMLHTTP');}catch(e){alert('Your browser does not support AJAX');return;}}}
this.onreadystatechange=function(updateFunc){this.updateFunc=updateFunc;}
this.send=function(url,param){param=param?param:"";this.xmlHttp.onreadystatechange=this.updateFunc;this.xmlHttp.open("POST",url,true);this.xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");this.xmlHttp.setRequestHeader("Content-length",param.length);this.xmlHttp.setRequestHeader("Connection","close");this.xmlHttp.send(encodeURI(param));this.handler=this.xmlHttp;}}