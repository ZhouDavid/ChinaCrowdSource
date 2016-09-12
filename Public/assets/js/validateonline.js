var userurl;
var usertoken;
var userid;

validateOnline();
//countOne();

var validatecounting;
function validateOnline(){ // 验证是否在其他地方登陆
	validatecounting = setInterval("validateOnlineIter();",60000); // 1分钟调用一次
}
function validateOnlineIter(){
	if($('#usertype').val() == 'requester') {
		userid = $('#requester_id').val();
		usertoken = $('#requester_token').val();
		userurl = api_url+'/requester/'+userid+'/?token='+usertoken;
	}
	else if($('#usertype').val() == 'worker') {
		userid = $('#worker_id').val();
		usertoken = $('#worker_token').val();
		userurl = api_url+'/worker/'+userid+'/?token='+usertoken;
	}
	if(usertoken == undefined || usertoken == "") {
		// do nothing
	}
	else {
		$.get(     
	        userurl, 
	        function(data, status) {
				if(status=="success") {
					if(data.id != undefined) {
					}
					else {
						alert(display_lang['please login again']);
						location.href=web_url+'/Index/switchuser';
						//console.log(data);
						clearInterval(validatecounting);
					}
				}
				else {
					alert(display_lang["network connection fail!"]);
				}
			}
		);
	}
}