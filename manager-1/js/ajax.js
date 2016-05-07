<!--Begin
var max=0;
var index=1;
var http = getHTTPObject();
function getHTTPObject() { 
	var xmlhttp;

	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') { 
		try{
			xmlhttp = new XMLHttpRequest(); 
		}catch(e){ 
			xmlhttp = false;
		}
	}
	return xmlhttp; 
}
function checkfrm(){
	if(document.frm.ssh_input.value==""){
		alert("Pls enter ssh values");
	}
	else{
		Begin();
	}
}
function Begin(){
	checkemail("begin");
}
function checkemail(Line){
	if(max>1){
		document.frm.ssh_input.disabled = true;
		document.frm.check_ssh.disabled = true;
	}
	else{
		document.frm.ssh_input.disabled = false;
		document.frm.check_ssh.disabled = false;
		var sounds="sounds/win.wav";
						chip=new Audio(sounds);
						chip.volume=1;
						chip.play();
	}
	if(Line=="begin"){
		var check_box=document.frm.check_box.value;
		var temp = document.frm.ssh_input.value;
		var xlist = temp.split("\n");
		max = xlist.length;
		
		temp = temp.replace(xlist[0]+"\n","");
		if(max==1){
			temp = temp.replace(xlist[0],"");
		}
		checkemail(xlist[0]);
		document.frm.ssh_input.value = temp;
	}
	else{
		document.getElementById('num_ssh_input').innerHTML=1+parseInt(document.getElementById('num_ssh_input').innerHTML);
		var url="check_ssh.php";
		http.onreadystatechange = function(){
			if(http.readyState == 4){
				if(http.responseText!=""&&http.responseText!="Pls enter full value"){
					if(http.responseText=="oke")
					{
						document.getElementById('num_ssh_oke').innerHTML=1+parseInt(document.getElementById('num_ssh_oke').innerHTML);
						document.getElementById('ssh_oke').innerHTML +=Line+"\n";
					}
					else
					{
						document.getElementById('num_ssh_error').innerHTML=1+parseInt(document.getElementById('num_ssh_error').innerHTML);
						document.getElementById('ssh_error').innerHTML +=Line+"\n";
					}
				}
				if(max!=1){
					Begin();
				}

			}
		}
		var para = "ip="+Line+"&check_box="+check_box;
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", para.length);
		http.setRequestHeader("Connection", "close");
		http.send(para);
	}
}
//End-->