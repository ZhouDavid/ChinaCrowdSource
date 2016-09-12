$(document).ready(function(){

$('#use_this_template').click(function() {
	//window.location.href = web_url + "/Requester/build_job";
	$.post(web_url+'/Requester/createjob', {},
		function(data, status) {
			if (status=="success") {
				if (data.code==0) {
					//var cc = "{$Think.lang.task create}";
					alert(display_lang["task create"]);
					//alert(cc);
					window.location.href = web_url + "/Requester/build_job";
				}
				else {
					//alert(data.code);
					//alert("error code:"+data.code+". Task create failed!");
					error(data.code);
				}
			}
			else{
				alert(display_lang["ajax error. Task create failed!"]);
			}
		});
});

});

function SetLang()
{
	return document.getElementsByClassName("lang")[0].name;
}
