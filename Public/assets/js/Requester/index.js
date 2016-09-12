$(document).ready(function(){

$('#create_jobs').click(function(){
	/*$.post(
		web_url+'/Requester/get_templates', {},
		function(data, status) {
			if(status=="success") {
				if (data.code==0){
					window.location.href = web_url + "/Requester/new_from_template";
				}
				else
					error(data.code);
			}
			else {
				alert(display_lang["ajax error. Template load fail!"]);
			}
		}
	);*/
	window.location.href = web_url + "/Requester/new_from_template";
});

$('tbody tr[data-href]').mouseover(function(){
	$(this).addClass("tr_select");
});

$('tbody tr[data-href]').mouseout(function(){
	$(this).removeClass("tr_select");
});

$('tbody tr[data-href]').click( function() {
		window.location = $(this).attr('data-href');
	}).find('button,a').hover( function() {
		$(this).parents('tr').unbind('click');
	}, function() {
		$(this).parents('tr').click( function() {
			window.location = $(this).attr('data-href');
		});
	});

/*$('tbody tr[data-href]').click( function() {
		window.location = $(this).attr('data-href');
	}).find('a').hover( function() {
		$(this).parents('tr').unbind('click');
	}, function() {
		$(this).parents('tr').click( function() {
			window.location = $(this).attr('data-href');
		});
	});*/

$("#verify-email-button-requester").click(function(){

	$.post(
		api_url+'/account/verify-email?token='+$('#requester_token').val(),
		{
		 	type: "requester",
		 	language: $('#lang').val()	
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					
					alert(display_lang["send email successfully"]);
				}
				else {
					alert(display_lang['send email failed']);
					//console.log(data.message);
					window.location.href = web_url + "/Requester/verifyemail";
				}
			}
			else {
				alert(display_lang['reset password request failed']);
			}
		}
	);
});

var action = window.location.pathname.split("/");
if(action[action.length-1] == "index" && window.location.hostname != getHostName(document.referrer)){


	var vtoken = getPar("vtoken");
	$.post(
		api_url+'/account/check-vtoken',
		{
		 	vtoken: vtoken,
		},
		function(data, status) {
			if(status=="success") {
				if(data.code == 0) {
					
					$.post(web_url+'/Requester/changeStatus');
					alert(display_lang['verify successfully']);
					url = web_url + '/Requester/index';
					go_to(url);
				}
				else {
					alert(display_lang['verify failed']);
					//console.log(data.message);
					url = web_url + "/Requester/verifyemail";
					go_to(url);
				}
			}
			else {
				alert(display_lang['reset password request failed']);
			}
		}
	);
	}
});

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

function Terminate(task_id)
{
	var data = {};
	data['task_id'] = task_id;
	$.ajax({
		type: 'post',
		url: api_url+'/workflow/end/?token='+$("#requester_token").val(),
		data: data,
		success: function(data) {
			if (data.code==0)
				window.location.href = web_url + "/Requester/index";
			else
				error(data.code);
		}
	});
}

function Delete(task_id)
{
	$.ajax(api_url+'/task/'+task_id+'/?token='+$("#requester_token").val(),{    
        	"type":"DELETE",         
        	success:function(data){
        		window.location.href = web_url + "/Requester/index";
        	}    
    	});
}

function getHostName(href){

	if(href == "") return "";

	var l = document.createElement("a");
    l.href = href;
    return l.hostname;
}

function go_to(url){
	
    var referLink = document.createElement('a');
    referLink.href = url;
    document.body.appendChild(referLink);
    referLink.click();
}
