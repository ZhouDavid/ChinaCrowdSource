$(document).ready(function(){

	$.post(web_url+'/Requester/getjobstatus', {}, 
		function(data, status) {
			if (status=="success")
			{
				if (data['status']=="init")
				{
					alert(display_lang["you need to build your task!"]);
					window.location.href = web_url + "/Requester/build_job";
				}
				else if (data['status']=="option")
				{
					alert(display_lang["you need to upload data!"]);
					window.location.href = web_url+ "/Requester/upload_data";
				}
				else if (data['status']=="publish")
				{
					alert(display_lang["you have already published your task!"]);
					window.location.href = web_url+ "/Requester/monitor";
				}
			}
		});


$('#publishtask').click(function() {
	//window.location.href = web_url + "/Requester/build_job";
	var r = confirm(display_lang["Are you sure to PUBLISH?"]);
	if (r==true) {
		var data = {};
		data['task_id'] = $("#task_id").val();
		$.ajax({
			type: 'post',
			url: api_url+'/workflow/publish/?token='+$("#requester_token").val(),
			data: data,
			beforeSend:function()
			{
			//这里是开始执行方法，显示效果，效果自己写
				//alert("dasda");
				$("#progressImgage").show().css({
					"display":"block",
                    "position": "fixed",
                    "top": "50%",
                    "left": "50%",
                    "margin-top": function () { return -1 * $("#progressImgage").height() / 2; },
                    "margin-left": function () { return -1 * $("#progressImgage").width() / 2; }
                });
                $("#maskOfProgressImage").show().css("opacity", "0.1");
			},
			complete:function()
			{
			//方法执行完毕，效果自己可以关闭，或者隐藏效果
				//alert("dasd");
				$("#progressImgage").hide();
                $("#maskOfProgressImage").hide();
			},
			success:function(data){
				//alert(JSON.stringify(data));
				if (data.code==0)
				{
					alert(display_lang["publish success!"]);
					window.location.href=web_url + "/Requester/index";
				}
				/*else if (data.code==1310)
				{
					alert("money is not enough!");
					window.location.href=web_url + "/Requester/Profile";
				}*/
				else
					error(data.code);
			}
		});
	}
});

});
