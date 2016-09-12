$(document).ready(function(){

$('#requester_signup').click(function(){

	if(!isEmail($("#user_email_requester").val())){
		alert(display_lang['email format error']);
		return;
	}

	if($("#user_password_requester").val().length < 8){
		alert(display_lang['need long password']);
		return;
	}

	if($("#user_password_requester").val() != $("#user_password_confirmation_requester").val()){
		alert(display_lang['passwords do not match']);
		return;
	}

	$.post(
		web_url+'/Index/dosignup',
		{
			username: $("#user_name_requester").val(),
		 	password: $("#user_password_requester").val(),
		 	email: $("#user_email_requester").val(),
		 	type: "requester"
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					//alert("register success!");
					window.location.href=web_url+'/Requester/verifyemail';
				}
				else {
					if(data.code == 1200)
						alert(display_lang['user exists']);		
					else if(data.code == 1204)
						alert(display_lang['email exists']);
					else console.log(data);
				}
			}
			else {
				alert(display_lang['register fail']);
			}
		}
	);
});

$('#requester_signin').click(function(){
	$.post(
		web_url+'/Index/dosignin',
		{
			username: $("#user_name_requester").val(),
		 	password: $("#user_password_requester").val(),
		 	type: "requester"
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					//alert("login success!");
					if(data.result.result['status'] == "1")
						window.location.href=web_url+'/Requester/index';
					else window.location.href=web_url+'/Requester/verifyemail';
				}
				else {
					console.log(data);
					alert(data.message);
				}
			}
			else {
				alert(display_lang['login fail']);
			}
		}
	);
});

$('#worker_signup').click(function(){

	if(!isEmail($("#user_email_worker").val())){
		alert(display_lang['email format error']);
		return;
	}

	if($("#user_password_worker").val().length < 8){
		alert(display_lang['need long password']);
		return;
	}

	if($("#user_password_worker").val() != $("#user_password_confirmation_worker").val()){
		alert(display_lang['passwords do not match']);
		return;
	}

	$.post(
		web_url+'/Index/dosignup',
		{
			username: $("#user_name_worker").val(),
		 	password: $("#user_password_worker").val(),
		 	email: $("#user_email_worker").val(),
		 	type: "worker"
		},
		function(data, status) {
			if(status=="success") {
				console.log("status");
				console.log(status);
				if(data.code == 0) {
					//alert("register success!");
					window.location.href=web_url+'/Worker/verifyemail';
				}
				else {
					if(data.code == 1200)
						alert(display_lang['user exists']);		
					else if(data.code == 1204)
						alert(display_lang['email exists']);
					else console.log(data);
				}
			}
			else {
				alert(display_lang['register fail']);
			}
		}
	);
});

$('#worker_signin').click(function(){
	$.post(
		web_url+'/Index/dosignin',
		{
			username: $("#user_name_worker").val(),
		 	password: $("#user_password_worker").val(),
		 	type: "worker"
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					
					if(data.result.result['status'] == "1")
						window.location.href=web_url+'/Worker/index';
					else window.location.href=web_url+'/Worker/verifyemail';
				}
				else {
					console.log(data);
					alert(data.message);
				}
			}
			else {
				alert(display_lang['login fail']);
			}
		}
	);
});

$("#worker-reset-request").click(function(){
	var email = $('#user-email').val();

	if(!isEmail(email)){
		alert(display_lang['email format error']);
		return;
	}

	$.post(
		api_url+'/account/resetpwd-request',
		{
			email: email,
		 	language: $('#lang').val(),
		 	type: "worker"
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					$('#reset-request-success').show();					
				}
				else {
					console.log(data);
					if(data.code == "1203")
						alert(display_lang["email hasn't been registered"]);
					else if(data.code == "1600")
						alert(display_lang["send email failed"]);
					else alert(data.message);
				}
			}
			else {
				alert(display_lang['reset password request failed']);
			}
		}
	);
});

$("#requester-reset-request").click(function(){
	var email = $('#user-email').val();

	if(!isEmail(email)){

		alert(display_lang["email format error"]);
		return;
	}

	$.post(
		api_url+'/account/resetpwd-request',
		{
			email: email,
		 	language: $('#lang').val(),
		 	type: "requester"
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					$('#reset-request-success').show();					
				}
				else {
		
					if(data.code == "1203")
						alert(display_lang["email hasn't been registered"]);
					else if(data.code == "1600")
						alert(display_lang["send email failed"]);
					else alert(data.message);

					console.log(data);
				}
			}
			else {
				alert(display_lang['reset password request failed']);
			}
		}
	);
});

$("#add-new-password").click(function(){

	var pwd = $('#user_password').val();
	var pwdc = $('#user_password_confirmation').val();

	if(pwd.length < 8){
		alert(display_lang['need long password']);
		return;
	}

	if(pwd != pwdc){
		alert(display_lang['passwords do not match']);
		return;
	}	

	$.post(
		api_url+'/account/reset-password',
		{
			vtoken: getPar("vtoken"),
			password: pwd,
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					alert(display_lang['reset success']);
					window.location.href = web_url + "/Index/signin";
				}
				else {
					alert(display_lang['vtoke error']);
					console.log(data.message);
					window.location.href = web_url + "/Index/signin";
				}
			}
			else {
				alert(display_lang['reset password request failed']);
			}
		}
	);
});

$('#reset-request-success').hide();

var action = window.location.pathname.split("/");
if(action[action.length-1] == "donewpwd_worker" || action[action.length-1] == "donewpwd_requester"){

	var vtoken = getPar("vtoken");
	var type = getPar("type");

	$.post(
		api_url+'/account/check-vtoken',
		{
		 	vtoken: vtoken,
		 	type: type
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
				}
				else {
					alert(display_lang['vtoke error']);
					console.log(data.message);
					window.location.href = web_url + "/Index/signin";
				}
			}
			else {
				alert(display_lang['reset password request failed']);
			}
		}
	);
}

});

function subWSignupCheck()  
{
    if(event.keyCode==13)  
    {
    	$('#worker_signup').click();
    }
}

function subRSignupCheck()  
{
    if(event.keyCode==13)  
    {
    	$('#requester_signup').click();
    }
}

function subWSigninCheck()  
{
    if(event.keyCode==13)  
    {
    	$('#worker_signin').click();
    }
}

function subRSigninCheck()  
{
    if(event.keyCode==13)  
    {
    	$('#requester_signin').click();
    }
}

function isEmail(str){ 
	var reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	return reg.test(str); 
}

function getPar(par){
    //获取当前URL
    var local_url = document.location.href; 
    //获取要取得的get参数位置
    var get = local_url.indexOf(par +"=");
    if(get == -1){
        return false;   
    }   
    //截取字符串
    var get_par = local_url.slice(par.length + get + 1);    
    //判断截取后的字符串是否还有其他get参数
    var nextPar = get_par.indexOf("&");
    if(nextPar != -1){
        get_par = get_par.slice(0, nextPar);
    }
    return get_par;
}
