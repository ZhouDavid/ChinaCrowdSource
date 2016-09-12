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

/*$('#create_jobs').click(function(){
	$.post(
		web_url+'/Requester/get_templates', {},
		function(data, status) {
			if(status=="success") {
				if (data.code==0)
					window.location.href = web_url + "/Requester/new_from_template";
				else
					alert(data.code+"template load fail!");
			}
			else {
				alert("template load fail!");
			}
		}
	);
});*/

/*$('.template1').click(function(){
	$.post(web_url+'/Requester/get_template', {},
		function(data, status) {
			if(status=="success") {
				if (data.code==0)
					window.location.href = web_url + "/Requester/new_job";
				else
					alert("template load fail!");
			}
			else {
				alert("template load fail!");
			}
		}
	);
});*/

/*$('#use_this_template').click(function() {
	//window.location.href = web_url + "/Requester/build_job";
	$.post(web_url+'/Requester/createjob', {},
		function(data, status) {
			if (status=="success") {
				if (data.code==0) {
					alert("task create!");
					window.location.href = web_url + "/Requester/build_job";
				}
				else
					alert("task create failed!");
			}
			else{
				alert("task create failed!");
			}
		});
});*/

/*$('#publishtask').click(function() {
	//window.location.href = web_url + "/Requester/build_job";
	var r = confirm("Are you sure to PUBLISH?");
	if (r==true) {
		$.post(web_url+"/Requester/publish", {},
			function(data,status){
				if (status=="success")
				{
					alert(JSON.stringify(data));
					if (data.code==0)
					{
						alert("publish success!");
						window.location.href=web_url + "/Requester/index";
					}
				}
			});
	}
});*/

/*$('tbody tr[data-href]').mouseover(function(){
	$(this).addClass("tr_select");
});

$('tbody tr[data-href]').mouseout(function(){
	$(this).removeClass("tr_select");
});

$('tbody tr[data-href]').click( function() {
		window.location = $(this).attr('data-href');
	}).find('a').hover( function() {
		$(this).parents('tr').unbind('click');
	}, function() {
		$(this).parents('tr').click( function() {
			window.location = $(this).attr('data-href');
		});
	});*/

});
