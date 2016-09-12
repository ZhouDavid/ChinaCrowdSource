$(document).ready(function() {
	$.post(web_url+'/Requester/getjobstatus', {}, 
		function(data, status) {
			if (status=="success")
			{
				//alert(JSON.stringify(data));
				if (data['status']=="init") {
					$("#data").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');
					$("#qualification_test").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');
					$("#preview").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');
					$("#publish").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');
					$("#results").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');
					$("#managenextstep").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');

				}
				else if (data['status']=="option")
				{
					//$("#data").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');
					$("#preview").attr('href', 'javascript:alert(display_lang["you need to upload data!"]);');
					$("#publish").attr('href', 'javascript:alert(display_lang["you need to upload data!"]);');
					$("#results").attr('href', 'javascript:alert(display_lang["you need to upload data!"]);');
					$("#managenextstep").attr('href', 'javascript:alert(display_lang["you need to upload data!"]);');
				}
				else if (data['status']=="publish")
				{
					$("#build_task").attr('href', 'javascript:alert(display_lang["you have published your task, cannot change your setting!"]);');
					$("#data").attr('href', 'javascript:alert(display_lang["you have published your task, cannot change your setting!"]);');
					$("#qualification_test").attr('href', 'javascript:alert(display_lang["you have published your task, cannot change your setting!"]);');
					$("#preview").attr('href', 'javascript:alert(display_lang["you have published your task, cannot change your setting!"]);');
					$("#task_setting").attr('href','javascript:alert(display_lang["you have published your task, cannot change your setting!"]);');
					$("#publish").attr('href', 'javascript:alert(display_lang["you have published your task, cannot change your setting!"]);');
					//$("#results").attr('href', 'javascript:alert(display_lang["you need to build your task!"]);');
				}
				else {
					$("#results").attr('href', 'javascript:alert(display_lang["you need to publish your task!"]);');
				}
			}
		});
});
