$(document).ready(function() {

	$.post(web_url+'/Requester/getjobstatus', {}, 
		function(data, status) {
			if (status=="success")
			{
				if (data['status']=="publish")
				{
					alert(display_lang["you have already published your task!"]);
					window.location.href = web_url+ "/Requester/monitor";
				}
			}
		});

	$("#savequality").click(function(){
		var isgeo = 0;
		if (document.getElementById("isgeo").checked)
			isgeo = 1;
		else
			isgeo = 0;

		var developer = 0;
		if (document.getElementById("developer").checked)
			developer = 1;
		else
			developer = 0;
		var testmode = 0;
		if (document.getElementById("test_mode").checked)
			testmode = 1;
		else
			testmode = 0;
		$.post(web_url+'/Requester/task_update',
		{
			judgements_per_unit: $('#judgements_per_unit').val(),
			units_per_page: $('#units_per_page').val(),
			price: $('#payment').val(),
			testmode: testmode,
			developer: developer,
			isgeo: isgeo,
			developer_site: $("#developer_site").val()
			//units_for_qualification_test: $('#units_for_qualification_test').val(),
			//min_accuracy: $('#min_accuracy').val()
			//golden_units_per_page: $('#golden_units_per_page').val()
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

	$("#managenextstep").click(function(){
		var isgeo = 0;
		if (document.getElementById("isgeo").checked)
			isgeo = 1;
		else
			isgeo = 0;
		var developer = 0;
		if (document.getElementById("developer").checked)
			developer = 1;
		else
			developer = 0;
		var testmode = 0;
		if (document.getElementById("test_mode").checked)
			testmode = 1;
		else
			testmode = 0;
		$.post(web_url+'/Requester/task_update',
		{
			judgements_per_unit: $('#judgements_per_unit').val(),
			units_per_page: $('#units_per_page').val(),
			price: $('#payment').val(),
			testmode: testmode,
			developer: developer,
			isgeo: isgeo,
			developer_site: $("#developer_site").val()
			//units_for_qualification_test: $('#units_for_qualification_test').val(),
			//min_accuracy: $('#min_accuracy').val()
			//golden_units_per_page: $('#golden_units_per_page').val()
		}, 
		function(data, status) {
			if (status=="success")
			{
				//alert(JSON.stringify(data));
				if (data.code==0)
				{
					alert(display_lang['update success!']);
					window.location.href = web_url + "/Requester/launch";
				}
				else
					error(data.code);
			}
		});
	});
});
