//var filecontent;
$(document).ready(function() {

	$.post(web_url+'/Requester/getjobstatus', {}, 
		function(data, status) {
			if (status=="success")
			{
				if (data['status']=="init")
				{
					alert(display_lang["you need to build your task!"]);
					window.location.href = web_url + "/Requester/build_job";
				}
				/*else if (data['status']=="option")
				{
					alert(display_lang["you need to upload data!"]);
					window.location.href = web_url+ "/Requester/upload_data";
				}*/
				else if (data['status']=="publish")
				{
					alert(display_lang["you have already published your task!"]);
					window.location.href = web_url+ "/Requester/monitor";
				}
			}
		}
	);

	$.post(
			web_url + '/Requester/get_task_sample',{},
			function(data, status)
			{
				if (status="success")
				{
					//alert(data);
					$("#sample_file_qualification").attr('href',api_url+data['golden-sample']+"?token="+data['token']);
					$("#task_id")[0].value = data['id'];
				}
			});

	$("#savequalification").click(function(){
		$.post(web_url+'/Requester/task_update_qualification',
		{
			//judgements_per_unit: $('#judgements_per_unit').val(),
			//units_per_page: $('#units_per_page').val(),
			units_for_qualification_test: $('#units_for_qualification_test').val(),
			min_accuracy: $('#min_accuracy_for_qualification_test').val(),
			golden_units_in_first_pages: $('#golden_units_in_first_pages').val(),
			min_accuracy_hidden: $('#min_accuracy_hidden').val()
		}, 
		function(data, status) {
			if (status=="success")
			{
				//alert(JSON.stringify(data));
				if (data.code==0)
				{
					alert(display_lang['update success!']);
					//window.location.href = web_url + "/Requester/launch";
				}
				else
					error(data.code);
			}
		});
	});

	$("#qualificationnextstep").click(function(){
		$.post(web_url+'/Requester/task_update_qualification',
		{
			//judgements_per_unit: $('#judgements_per_unit').val(),
			//units_per_page: $('#units_per_page').val(),
			units_for_qualification_test: $('#units_for_qualification_test').val(),
			min_accuracy: $('#min_accuracy_for_qualification_test').val(),
			golden_units_in_first_pages: $('#golden_units_in_first_pages').val(),
			min_accuracy_hidden: $('#min_accuracy_hidden').val()
		}, 
		function(data, status) {
			if (status=="success")
			{
				//alert(JSON.stringify(data));
				if (data.code==0)
				{
					alert(display_lang['update success!']);
					window.location.href = web_url + "/Requester/manage_quality";
				}
				else
					error(data.code);
			}
		});
	});


	$("#button_up").click(function(){
		//var formdata = new FormData($("#data_up")[0]);
		//console.log(formdata);
		//return;
		//alert(filecontent);
		/*$.post("http://166.111.71.88:5678/workflow/upload/",
			{task_id:$("#task_id").val(),
			data:filecontent},
				function(data, status)
				{
					//console.log(data);
					//if (status=="success")
					//{
						//if (data.code==0)
						//{
							//alert("success");
							//window.location.href = "";
						//}
					//}
					window.location.href = web_url+'/Requester/preview';
				});*/
		$("#qualification_up").ajaxSubmit({
			"success":function(data) {
				console.log(data);
				if (data.code==0)
					alert(display_lang["golden upload success!"]);
				//window.location.href = web_url+'/Requester/preview';
				else
					error(data.code);
			}
		});
	});

	/*$("#data_upload").click(function() {
		$.post(web_url + '/Requester/data_up',
			{
				task_id:$("#task_id").val(),
				data:$("#data").val()
			},
			function(data, status)
			{
				if (status=="success")
				{
					if (data.code==0)
					{
						//alert("success");
						window.location.href = web_url+'/Requester/preview';
					}
				}
			});
	});*/
	/*$("#data_up").submit(function(){
			var formdata = new FormData($(this)[0]);
			//console.log(formdata);
			alert(formdata.toString());
			$.post("http://166.111.71.88:5678/workflow/upload",formdata,
				function(data, status)
				{
					alert(data);
					if (status=="success")
					{
						if (data.code==0)
						{
							alert("success");
							//window.location.href = "";
						}
					}
				});
			return false;
		});*/

});
