$(document).ready(function(){

$('.template1').click(function(){
	$.post(web_url+'/Requester/get_template', {template_id:$(this).val()},
		function(data, status) {
			if(status=="success") {
				if (data.code==0)
					window.location.href = web_url + "/Requester/new_job";
				else
					error(data.code);
			}
			else {
				alert(display_lang["ajax error. Template load fail!"]);
			}
		}
	);
});

});
