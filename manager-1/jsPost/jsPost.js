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
		var check_box=document.frm.check_box.value;
		var offerId=offerId=document.getElementsByName("offerId_textbox")[0].value;
		alert(offerId);
		if(offerId=="INPUT OFFER ID"||offerId=="")
		{
			
			var offerId=document.getElementsByName("offerId")[0].value;
		}
		document.getElementById('num_ssh_input').innerHTML=1+parseInt(document.getElementById('num_ssh_input').innerHTML);
		var url="./jsPost/jsPost.php";
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
		var para = "ip="+Line+"&check_box="+check_box+"&offerId="+offerId;
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", para.length);
		http.setRequestHeader("Connection", "close");
		http.send(para);
	}
}
//End-->

function edit_user(username)
{
	$.post('./jsPost/jsPost.php',{show_edit_user:'yes',username:username},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}
function mod_edit_user(username)
{
	$.post('./jsPost/jsPost.php',{mod_show_edit_user:'yes',username:username},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}

function post_edit_user()
{
	var username=document.getElementsByName("username")[0].value;
	var password=document.getElementsByName("password")[0].value;
	var email=document.getElementsByName("email")[0].value;
	var banned=document.getElementsByName("banned")[0].value;
	var groupname=document.getElementsByName("groupname")[0].value;
	var codelogin=document.getElementsByName("codelogin")[0].value;

	$.post('./jsPost/jsPost.php',{post_edit_user:"yes",username:username,password:password,email:email,banned:banned,groupname:groupname,codelogin:codelogin},function (data){
		if(data=="error")
		{
			document.getElementById("reponse_post").innerHTML="Edit user "+username+" error!";
		}
		else
		if(data=="error_codelogin")
		{
			alert("Code login already exist! Please try again!");
		}
		else
		{
			document.getElementById("reponse_post").innerHTML="Edit user "+username+" success!";
			document.getElementById("tr_"+username).innerHTML=data;
		}
		
	});
}
function mod_post_edit_user()
{
	var username=document.getElementsByName("username")[0].value;
	var password=document.getElementsByName("password")[0].value;
	var email=document.getElementsByName("email")[0].value;
	var banned=document.getElementsByName("banned")[0].value;
	var groupname=document.getElementsByName("groupname")[0].value;
	var codelogin=document.getElementsByName("codelogin")[0].value;

	$.post('./jsPost/jsPost.php',{mod_post_edit_user:"yes",username:username,password:password,email:email,banned:banned,groupname:groupname,codelogin:codelogin},function (data){
		if(data=="error")
		{
			document.getElementById("reponse_post").innerHTML="Edit user "+username+" error!";
		}
		else
		if(data=="error_codelogin")
		{
			alert("Code login already exist! Please try again!");
		}
		else
		{
			document.getElementById("reponse_post").innerHTML="Edit user "+username+" success!";
			document.getElementById("tr_"+username).innerHTML=data;
		}
	});
}

function post_add_user()
{
	var username=document.getElementsByName("username")[0].value;
	var password=document.getElementsByName("password")[0].value;
	var email=document.getElementsByName("email")[0].value;
	var verify=document.getElementsByName("verify")[0].value;
	var groupname=document.getElementsByName("groupname")[0].value;
	var codelogin=document.getElementsByName("codelogin")[0].value;
	$.post('./jsPost/jsPost.php',{add_user:"yes",username:username,password:password,email:email,verify:verify,codelogin:codelogin,groupname:groupname},function (data){

		if(data==4)
		{
			alert("Code login "+codelogin+" exist! Please try again!");
		}
		else
		if(data==2)
		{
			alert("Username "+username+" exist! Please try again!");
		}
		else
		if(data==3)
		{
			alert("Please input all fields!");
		}
		else
		if(data==0)
		{
			alert("Add user error! Please try again!");
		}
		else
		if(data==1)
		{
			if(verify==1)
			{
				var status_verify="<span style='color:green'>Verified</span>";
			}
			else
			{
				var status_verify="<div class='verify_"+username+"'><center><a style='color:red' class='mousepointer' onclick=\"verify('"+username+"')\">Verify</a></center></div>";
			}
			//id=parseInt(document.querySelector('#list_members tr:last-child td:first-child').innerHTML)+1;
			document.getElementById("reponse_post").innerHTML="Add user "+username+" success!";
			$('#list_members tr:last').after("<tr class='gradeA' id='tr_"+username+"'><td>"+username+"</td><td>"+email+"</td><td>0</td><td>0</td><td>"+groupname+"</td><td>"+status_verify+"</td><td><center><div class='ban_"+username+"'><a class='mousepointer' style='color:green' onclick=\"ban_user('"+username+"')\">BAN</a></div></center></td><td><center><center><a class=\"btn btn-warning button_tb manager mousepointer\" onclick=\"edit_user('"+username+"')\">EDIT</a><a class=\"btn btn-danger button_tb manager mousepointer\" onclick=\"delete_user('"+username+"')\">DELETE</a></center></center></td></tr>");

		}
	});
}
function get_time_now()
{
	var now = new Date();
	var dd = now.getDate();
	var mm = now.getMonth()+1; //January is 0!
	var yyyy = now.getFullYear();
	var hh = now.getHours();
	var mimi = now.getMinutes();
	var ss = now.getSeconds();

	if(dd<10) {
		dd='0'+dd;
	} 

	if(mm<10) {
		mm='0'+mm;
	}
	if(hh<10) {
		hh='0'+hh;
	}
	if(mimi<10) {
		mimi='0'+mimi;
	}
	if(ss<10) {
		ss='0'+ss;
	}
	now = mm+'-'+dd+'-'+yyyy;
	return now;
}
function find_user()
{
	var text_search=document.getElementsByName("text_search")[0].value;
	$.post('./jsPost/jsPost.php',{text_search:text_search},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}

function verify(username)
{
	$.post('./jsPost/jsPost.php',{verify_user:username},function (data){
	if(data!=1)
	{
		document.getElementById("reponse_post").innerHTML="Verify user "+username+" error!";
	}
	else
	{		
		document.getElementById("reponse_post").innerHTML="Verify user "+username+" completed!";
		document.getElementsByClassName("verify_"+username)[0].innerHTML="<center ><span style='color:green'>Verified</span></center>";
	}
	});
}

function ban_user(username)
{
	$.post('./jsPost/jsPost.php',{ban_user:username},function (data){
	if(data!=1)
	{

		document.getElementById("reponse_post").innerHTML="Ban user "+username+" error!";
	}
	else
	{		
		document.getElementById("reponse_post").innerHTML="Ban user "+username+" completed!";
		document.getElementsByClassName("ban_"+username)[0].innerHTML="<center ><a  style='color:red' class='mousepointer' onclick=\"unban_user('"+username+"')\">UNBAN</a></center>";
	}
	});
}

function status_paid_all(username,from_day,to_day,status_paid,netname,offerId)
{
	$.post('./jsPost/jsPost.php',{paid_user:username,from_day:from_day,to_day:to_day,status_paid:status_paid,netname:netname,offerId:offerId},function (data){
	if(data!=1)
	{
		document.getElementById("reponse_post").innerHTML=status_paid+" user "+username+" error!";
	}
	else
	{
		document.getElementById("reponse_post").innerHTML=status_paid+" user "+username+" completed!";
		document.getElementById("tr_"+username).innerHTML="";

	}
	});
}

function unban_user(username)
{
	$.post('./jsPost/jsPost.php',{unban_user:username},function (data){
	if(data!=1)
	{
		document.getElementById("reponse_post").innerHTML="Unban user "+username+" error!";
	}
	else
	{
		document.getElementById("reponse_post").innerHTML="Unban user "+username+" completed!";
		document.getElementsByClassName("ban_"+username)[0].innerHTML="<center><a style='color:green' class='mousepointer' onclick=\"ban_user('"+username+"')\">BAN</a></center>";

	}
	});
}
function delete_user(username)
{
	if(confirm('Are you sure delete user '+username+'???'))
	{
		$.post('./jsPost/jsPost.php',{delete_user:username},function (data){
			document.getElementById("reponse_post").innerHTML="Delete member "+username+" success!";
			document.getElementById("tr_"+username).innerHTML="";
		});
	}
}
function add_user()
{
	$.post('./jsPost/jsPost.php',{get_group_name:'yes'},function (data){
	if(data!='error')
	{
		var array_group=data.split('|');
		var list_group="<select name='groupname' class='form-control edit_member'>";
		for(i=0;i<array_group.length-1;i++)
		{
			list_group+="<option value='"+array_group[i]+"'>"+array_group[i]+"</option>";
		}
		list_group+="</select>";
		document.getElementById("reponse_post").innerHTML="<table style='width:40%;margin:0px auto'><form class='form' method='post' action='home.php'></form><tr><td>User name:</td><td><input class='form-control edit_member' type='text' name='username' value=''></td></tr><tr><td>Password:</td><td><input class='form-control edit_member' type='text' name='password' value=''></td></tr><tr><td>Email:</td><td><input type='text' class='form-control edit_member' name='email' value=''></td></tr><tr><td>Verify:</td><td><select name='verify' class='form-control edit_member'><option value='1'>Yes</option><option value='0'>No</option></select></td></tr><tr><td>Group</td><td>"+list_group+"</td></tr><tr><td>Code Login</td><td><input type='text' name='codelogin' class='form-control edit_member' value=''></td></tr><tr><td colspan='2'><center><input type='submit' class='btn btn-primary' name='edit_user' value='ADD USER' onclick='post_add_user()'></center></td></tr></table>";
	}
	else
	{
		document.getElementById("reponse_post").innerHTML="Please add a mod before adding mod! Click <a href='./index.php?mods'>here</a>!";
	}
	});
}


/////////////////////****************************************//////////////////
/////////////////////****************************************//////////////////


function edit_mod(modname)
{
	$.post('./jsPost/jsPost.php',{show_edit_mod:'yes',modname:modname},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}

function post_edit_mod()
{
	var modname=document.getElementsByName("modname")[0].value;
	var password=document.getElementsByName("password")[0].value;
	var email=document.getElementsByName("email")[0].value;
	$.post('./jsPost/jsPost.php',{post_edit_mod:"yes",modname:modname,password:password,email:email},function (data){
		if(data!="error")
		{
			document.getElementById("reponse_post").innerHTML="Edit mod "+modname+" success!";
			document.getElementById("tr_"+modname).innerHTML=data;
		}
		else
		{
			document.getElementById("reponse_post").innerHTML="Edit mod "+modname+" error!";
		}
	});
}

function post_add_mod()
{
	var modname=document.getElementsByName("modname")[0].value;
	var email=document.getElementsByName("email")[0].value;
	var password=document.getElementsByName("password")[0].value;
	$.post('./jsPost/jsPost.php',{add_mod:"yes",email:email,modname:modname,password:password},function (data){
		if(data==2)
		{
			alert("Modname "+modname+" exist! Please try again!");
		}
		else
		if(data==3)
		{
			alert("Please input modname and password!");
		}
		else
		if(data==0)
		{
			alert("Add mod error! Please try again!");
		}
		else
		if(data==1)
		{
			document.getElementById("reponse_post").innerHTML="Add user "+modname+" success!";
			$('#list_mods tr:last').after("<tr class='gradeA' id='tr_"+modname+"'><td>"+modname+"</td><td>"+email+"</td><td><center>0</center></td><td><center>0</center></td><td><center><a class='btn btn-warning button_tb manager mousepointer' onclick='edit_mod(\""+modname+"\")'>EDIT</a></center></td><td><center><a class='btn btn-danger button_tb manager mousepointer' onclick='ban_mod(\""+modname+"\")'>BAN</a></center></td></tr>");
		}
	});
}
function ban_mod(modname)
{
	$.post('./jsPost/jsPost.php',{ban_mod:modname},function (data){
	if(data!=1)
	{
		document.getElementById("reponse_post").innerHTML="Ban mod "+modname+" error!";
	}
	else
	{		
		document.getElementById("reponse_post").innerHTML="Ban mod "+modname+" completed!";
		document.getElementsByClassName("ban_"+modname)[0].innerHTML="<center ><a  class='btn btn-info button_tb manager mousepointer' onclick=\'unban_mod(\""+modname+"\")\'>UNBAN</a></center>";
	}
	});
}
function unban_mod(modname)
{
	$.post('./jsPost/jsPost.php',{unban_mod:modname},function (data){
	if(data!=1)
	{
		document.getElementById("reponse_post").innerHTML="Unban mod "+modname+" error!";
	}
	else
	{
		document.getElementById("reponse_post").innerHTML="Unban mod "+modname+" completed!";
		document.getElementsByClassName("ban_"+modname)[0].innerHTML="<center><a class='btn btn-danger button_tb manager mousepointer' onclick=\'ban_mod(\""+modname+"\")\'>BAN</a></center>";

	}
	});
}
function add_mod()
{
	document.getElementById("reponse_post").innerHTML="<table style='width:40%;margin:0px auto'><form class='form' method='post' action='home.php'></form><tr><td>Mod name:</td><td><input class='form-control edit_member' type='text' name='modname' value=''></td></tr><tr><td>Email:</td><td><input class='form-control edit_member' type='text' name='email' value=''></td></tr><tr><td>Password:</td><td><input class='form-control edit_member' type='text' name='password' value=''></td></tr><tr><td colspan='2'><center><input type='submit' class='btn btn-primary' name='edit_user' value='ADD MOD' onclick='post_add_mod()'></center></td></tr></table>";
}

/////////////////////****************************************//////////////////
/////////////////////****************************************//////////////////
function delete_offer(id)
{
	if(confirm('Are you sure delete offers id '+id+'???'))
	{
		$.post('./jsPost/jsPost.php',{delete_offer:id},function (data){
			if(data==1)
			{
				document.getElementById("reponse_post").innerHTML="Delete Offer id "+id+" success!";
				document.getElementById("tr_"+id).innerHTML="";
			}
			else
			{
				document.getElementById("reponse_post").innerHTML="Delete Offer id "+id+" error!";
			}
		});
	}
}

function action_offer_mobvista(id)
{
	
	var offerId=document.getElementsByName("offerId")[id].value;
	var name=document.getElementsByName("name")[id].value;
	var des=document.getElementsByName("des")[id].value;
	var url=document.getElementsByName("url")[id].value;
	var image_url=document.getElementsByName("image_url")[id].value;
	var country=document.getElementsByName("cc")[id].value;
	var network=document.getElementsByName("network_offer")[id].value;
	var payout_net=document.getElementsByName("payout_net")[id].value;
	var payout=document.getElementsByName("payout")[id].value;
	var os=document.getElementsByName("os_offer")[id].value;
	var offer_name=document.getElementsByName("offer_name")[id].value;
	var min_os_version=document.getElementsByName("min_os_version")[id].value;
	var max_os_version=document.getElementsByName("max_os_version")[id].value;
	var exclude_traffic=document.getElementsByName("exclude_traffic")[id].value;
	var preview_link=document.getElementsByName("preview_link")[id].value;
	var price_model=document.getElementsByName("price_model")[id].value;
	var app_category=document.getElementsByName("app_category")[id].value;
	var start_time=document.getElementsByName("start_time")[id].value;
	var start_date=document.getElementsByName("start_date")[id].value;
	var end_time=document.getElementsByName("end_time")[id].value;
	var end_date=document.getElementsByName("end_date")[id].value;
	var update_time=document.getElementsByName("update_time")[id].value;
	var update_date=document.getElementsByName("update_date")[id].value;
	var Effective_time=document.getElementsByName("Effective_time")[id].value;
	var effective_date=document.getElementsByName("effective_date")[id].value;
	var exclude_device=document.getElementsByName("exclude_device")[id].value;
	var carriers=document.getElementsByName("carriers")[id].value;
	var daily_cap=document.getElementsByName("daily_cap")[id].value;
	var creative_link=document.getElementsByName("creative_link")[id].value;
	var app_size=document.getElementsByName("app_size")[id].value;
	var app_rate=document.getElementsByName("app_rate")[id].value;
	var appreviewnum=document.getElementsByName("appreviewnum")[id].value;
	var appinstalls=document.getElementsByName("appinstalls")[id].value;
	var market=document.getElementsByName("market")[id].value;

	$.post('./jsPost/jsPost.php',{action_offer_mobvista:"yes",offerId:offerId,name:name,des:des,url:url,image_url:image_url,country:country,network:network,payout:payout,payout_net:payout_net,os:os,offer_name:offer_name,min_os_version:min_os_version,max_os_version:max_os_version,exclude_traffic:exclude_traffic,preview_link:preview_link,price_model:price_model,app_category:app_category,start_time:start_time,start_date:start_date,end_time:end_time,end_date:end_date,update_time:update_time,update_date:update_date,Effective_time:Effective_time,effective_date:effective_date,exclude_device:exclude_device,carriers:carriers,daily_cap:daily_cap,creative_link:creative_link,app_size:app_size,app_rate:app_rate,appreviewnum:appreviewnum,appinstalls:appinstalls,market:market},function (data){
		if(data!="Offer action successfully !")
		{
			document.getElementById("reponse_post").innerHTML=data;
		}
		else
		{
			document.getElementById("reponse_post").innerHTML=data;
			document.getElementById("td_"+offerId).innerHTML="<a class='btn btn-info button_tb manager' >Action</a>";
		}
	});
}
function action_offer_mobverify(id)
{
	
	var offerId=document.getElementsByName("offerId")[id].value;
	var name=document.getElementsByName("name")[id].value;
	var des=document.getElementsByName("des")[id].value;
	var url=document.getElementsByName("url")[id].value;
	var image_url=document.getElementsByName("image_url")[id].value;
	var country=document.getElementsByName("cc")[id].value;
	var network=document.getElementsByName("network_offer")[id].value;
	var payout_net=document.getElementsByName("payout_net")[id].value;
	var payout=document.getElementsByName("payout")[id].value;
	var os=document.getElementsByName("os_offer")[id].value;
	$.post('./jsPost/jsPost.php',{action_offer_mobverify:"yes",offerId:offerId,name:name,des:des,url:url,image_url:image_url,country:country,network:network,payout:payout,payout_net:payout_net,os:os},function (data){
		if(data!="Offer action successfully !")
		{
			document.getElementById("reponse_post").innerHTML=data;
		}
		else
		{
			document.getElementById("reponse_post").innerHTML=data;
			document.getElementById("td_"+offerId).innerHTML="<a class='btn btn-info button_tb manager' >Action</a>";
		}
	});
}

function paid_user_w(username,week)
{
	$.post('./jsPost/jsPost.php',{paid_user_w:username,week:week},function (data){
	if(data!=1)
	{

		document.getElementById("reponse_post").innerHTML="Paid user "+username+" error!";
	}
	else
	{		
		document.getElementById("reponse_post").innerHTML="Paid user "+username+" completed!";
		document.getElementsByClassName("paid_"+username)[0].innerHTML="<span class='paid_"+username+"'><a  class='mousepointer btn btn-info button_tb manager' onclick=\"unpaid_user_m('"+username+"','"+week+"')\">PAID</a></span>";
	}
	});
}

function unpaid_user_w(username,week)
{
	$.post('./jsPost/jsPost.php',{unpaid_user_w:username,week:week},function (data){
	if(data!=1)
	{

		document.getElementById("reponse_post").innerHTML="Unpaid user "+username+" error!";
	}
	else
	{		
		document.getElementById("reponse_post").innerHTML="Unpaid user "+username+" completed!";
		document.getElementsByClassName("paid_"+username)[0].innerHTML="<span class='paid_"+username+"'><a class='btn btn-danger button_tb manager mousepointer ' onclick=\"paid_user_m('"+username+"','"+week+"')\">UNPAID</a></span>";
	}
	});
}

function paid_user_m(username,week)
{
	$.post('./jsPost/jsPost.php',{paid_user_m:username,week:week},function (data){
	if(data!=1)
	{

		document.getElementById("reponse_post").innerHTML="Paid user "+username+" error!";
	}
	else
	{
		document.getElementById("reponse_post").innerHTML="Paid user "+username+" completed!";
		document.getElementsByClassName("paid_"+username)[0].innerHTML="<span class='paid_"+username+"'><a  class='mousepointer btn btn-info button_tb manager' onclick=\"unpaid_user_m('"+username+"','"+week+"')\">PAID</a></span>";
	}
	});
}

function unpaid_user_m(username,week)
{
	$.post('./jsPost/jsPost.php',{unpaid_user_m:username,week:week},function (data){
	if(data!=1)
	{
		document.getElementById("reponse_post").innerHTML="Unpaid user "+username+" error!";
	}
	else
	{		
		document.getElementById("reponse_post").innerHTML="Unpaid user "+username+" completed!";
		document.getElementsByClassName("paid_"+username)[0].innerHTML="<span class='paid_"+username+"'><a class='btn btn-danger button_tb manager mousepointer ' onclick=\"paid_user_m('"+username+"','"+week+"')\">UNPAID</a></span>";
	}
	});
}


function action_offer_avazu(id)
{
	var offerId=document.getElementsByName("offerId")[id].value;
	var name=document.getElementsByName("name")[id].value;
	var des=document.getElementsByName("des")[id].value;
	var url=document.getElementsByName("url")[id].value;
	var image_url=document.getElementsByName("image_url")[id].value;
	var country=document.getElementsByName("cc")[id].value;
	var network=document.getElementsByName("network_offer")[id].value;
	var payout_net=document.getElementsByName("payout_net")[id].value;
	var payout=document.getElementsByName("payout")[id].value;
	var os=document.getElementsByName("os_offer")[id].value;
	var offer_name=document.getElementsByName("offer_name")[id].value;
	var app_category=document.getElementsByName("app_category")[id].value;
	var app_rate=document.getElementsByName("app_rate")[id].value;
	var appreviewnum=document.getElementsByName("appreviewnum")[id].value;
	var appinstalls=document.getElementsByName("appinstalls")[id].value;
	var app_size=document.getElementsByName("app_size")[id].value;
	var min_os_version=document.getElementsByName("min_os_version")[id].value;
	var market=document.getElementsByName("market")[id].value;
	
	$.post('./jsPost/jsPost.php',{action_offer_avazu:"yes",offerId:offerId,name:name,des:des,url:url,image_url:image_url,country:country,network:network,payout:payout,payout_net:payout_net,os:os,offer_name:offer_name,app_category:app_category,app_rate:app_rate,appreviewnum:appreviewnum,appinstalls:appinstalls,app_size:app_size,min_os_version:min_os_version,market:market},function (data){
		if(data!="Offer action successfully !")
		{
			document.getElementById("reponse_post").innerHTML=data;
		}
		else
		{
			document.getElementById("reponse_post").innerHTML=data;
			document.getElementById("td_"+offerId).innerHTML="<a class='btn btn-info button_tb manager' >Action</a>";
		}
	});
}

function action_offer_bluetrackmedia(id)
{
	var offerId=document.getElementsByName("offerId")[id].value;
	var name=document.getElementsByName("name")[id].value;
	var des=document.getElementsByName("des")[id].value;
	var url=document.getElementsByName("url")[id].value;
	var offer_name=document.getElementsByName("offer_name")[id].value;
	var image_url=document.getElementsByName("image_url")[id].value;
	var country=document.getElementsByName("cc")[id].value;
	var network=document.getElementsByName("network_offer")[id].value;
	var payout_net=document.getElementsByName("payout_net")[id].value;
	var payout=document.getElementsByName("payout")[id].value;
	var os="";
	var x=document.getElementsByName("os_offer")[id];
	for (var i = 0; i < x.options.length; i++) 
	{		
		if(x.options[i].selected)
		{
			os+="|"+x.options[i].value;
		}
	}
	if(os=="")
	{
		alert("Please select os");
	}
	else
	{
		$.post('./jsPost/jsPost.php',{action_offer_bluetrackmedia:"yes",offerId:offerId,name:name,des:des,url:url,image_url:image_url,country:country,network:network,payout:payout,payout_net:payout_net,os:os,offer_name:offer_name},function (data){
		if(data!="Offer action successfully !")
		{
			document.getElementById("reponse_post").innerHTML=data;
		}
		else
		{
			document.getElementById("reponse_post").innerHTML=data;
			document.getElementById("td_"+offerId).innerHTML="<a class='btn btn-info button_tb manager' >Action</a>";
		}
		});
	}
}



function show_add_offer()
{
	$.post('./jsPost/jsPost.php',{show_add_offer:'yes'},function (data){
		if(data==0)
		{
			document.getElementById("reponse_post").innerHTML="<span style='color:red'>Does not exits network. Please add network <a target='_blank' href='./index.php?networks'>here</a></span>";
		}
		else
		{
			document.getElementById("reponse_post").innerHTML=data;
		}
	});
}

function show_edit_offer(id)
{
	$.post('./jsPost/jsPost.php',{show_edit_offer:'yes',id:id},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}
function post_edit_offer(offer_name)
{
	$.post('./jsPost/jsPost.php',{show_edit_offer:'yes',offer_name:offer_name},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}
/////////////////////****************************************//////////////////
/////////////////////****************************************//////////////////
function delete_wall(id)
{
	if(confirm('Are you sure delete offers wall id '+id+'???'))
	{
		$.post('./jsPost/jsPost.php',{delete_wall:id},function (data){
			if(data==1)
			{
				document.getElementById("reponse_post").innerHTML="Delete offer wall id "+id+" success!";
				document.getElementById("tr_"+id).innerHTML="";
			}
			else
			{
				document.getElementById("reponse_post").innerHTML="Delete offer wall id "+id+" error!";
			}
		});
	}
}
function show_add_wall()
{
	$.post('./jsPost/jsPost.php',{show_add_wall:'yes'},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}
function show_edit_wall(id)
{
	$.post('./jsPost/jsPost.php',{show_edit_wall:'yes',id:id},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}
/////////////////////****************************************//////////////////
/////////////////////****************************************//////////////////

function show_add_network()
{
		document.getElementById("reponse_post").innerHTML="<form action='' method='post'><table style='width:30%;margin:0px auto'><tr><td>Name</td><td>	<input type='text' name='name' class='txt' value='' /></td></tr><tr><td>	IPAddress</td><td><input type='text' name='ip' class='txt' value='' /></td></tr><tr><td>Status</td><td>	<select name='status'><option value='ON'>ON</option><option value='OFF'>OFF</option></select></td></tr><tr><td>API KEY</td><td><input type='text' name='api_key' class='txt' value='' /></td></tr><tr><td>Invoice</td><td><select type='text' name='payment' class='txt'><option value='week'>Week</option><option value='month'>Month</option></select></td></tr><tr><td colspan='2'><center><input type='submit' name='addNetwork' value='ADD NETWORK' class='btn btn-info'/></center>	<td></tr></table></form>";
}

function delete_network(id)
{
	if(confirm('Are you sure delete networks id '+id+'???'))
	{
		$.post('./jsPost/jsPost.php',{delete_network:id},function (data){
			if(data==1)
			{
				document.getElementById("reponse_post").innerHTML="Delete network id "+id+" success!";
				document.getElementById("tr_"+id).innerHTML="";
			}
			else
			{
				document.getElementById("reponse_post").innerHTML="Delete network id "+id+" error!";
			}
		});
	}
}
function show_edit_network(id)
{
	$.post('./jsPost/jsPost.php',{show_edit_network:'yes',id:id},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}
function post_edit_network(network_name)
{
	$.post('./jsPost/jsPost.php',{post_edit_network:'yes',network_name:network_name},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}
//////////////CATEGORY
function delete_category(id)
{
	if(confirm('Are you sure delete category id '+id+'???'))
	{
		$.post('./jsPost/jsPost.php',{delete_category:id},function (data){
			if(data==1)
			{
				document.getElementById("reponse_post").innerHTML="Delete Offer id "+id+" success!";
				document.getElementById("tr_"+id).innerHTML="";
			}
			else
			{
				document.getElementById("reponse_post").innerHTML="Delete Offer id "+id+" error!";
			}
		});
	}
}


function show_add_category()
{
	$.post('./jsPost/jsPost.php',{show_add_category:'yes'},function (data){
		document.getElementById("reponse_post").innerHTML=data;
	});
}

