$(document).ready(function() {

	$( "#append_data" ).removeClass("ui-button");
	$( "#append_data" ).removeClass("ui-widget");
	$( "#append_data" ).removeClass("ui-state-default");
	$( "#append_data" ).removeClass("ui-corner-all");
	
	var dialog;
	dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 600,
      width: 850,
      modal: true,
      buttons: {
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        //form[ 0 ].reset();
        //$(".siderbar").css("z-index", 1000);
        //allFields.removeClass( "ui-state-error" );
      }
    });
    $( "#append_data" ).click(function() {

    	$.post(web_url+'/Requester/getjobstatus', {}, 
		function(data, status) {
			if (status=="success")
			{
				if (data['status']!="publish")
				{
					alert(display_lang["you need to publish your task!"]);
					//window.location.href = web_url+ "/Requester/monitor";
				}
				else
				{
					dialog.dialog( "open" );
					//$(".siderbar").css("z-index", 100);
				}
			}
		});
    });

	$.post(web_url + '/Requester/get_task_sample',{},
			function(data, status)
			{
				if (status="success")
				{
					//alert(data);
					$("#sample_file").attr('href',api_url+data['normal-sample']+"?token="+data['token']);
					$("#task_id")[0].value = data['id'];
				}
			});

	$("#button_new").click(function(){
		$("#data_up").ajaxSubmit({
			"success":function(data) {
				console.log(data);
				if (data.code==0)
				{
					alert(display_lang["data upload success!"]);
					dialog.dialog( "close" );
					location.reload();
					//alert(JSON.stringify(data));
					//window.location.href = web_url+'/Requester/preview';
				}
				else
				{
					error(data.code);
					/*var code1 = data.code;
					if (code1==3)
					{
						alert("invalid token, please login");
					}
					if (code1==10)
					{
						alert("invalid token, please login");
					}
					if (code1==1300)
					{
						alert("upload file format error");
					}
					if (code1==1309)
					{
						alert("wrong task status");
					}
					if (code1==1312)
					{
						alert("no units!");
					}
					if (code1==1400)
					{
						alert("not a zip file.");
					}
					if (code1==1401)
					{
						alert("invalid zip file, maybe it contains invalid image, only allow .jpg, .png, jpeg.");
					}
					if (code1==1500)
					{
						alert("the request image doesn't exist on server.");
					}*/
				}
			}
		});
	});

	/*$("#savedeveloper").click(function(){
		var data = {};
		if (document.getElementById("developer").checked)
			data["developer"] = 1;
		else
			data["developer"] = 0;
		data["developer_site"] = $("#developer_site").val();
		$.ajax(api_url+'/task/'+$('#task_id').val()+'/?token='+$('#requester_token').val(),{    
        	"type":"PATCH", 
        	"data":data,        
        	success:function(data){
        		//alert(JSON.stringify(data));
        		if (data.code==0)
        			alert("developer mode upload success.");
        		//location.href = web_url+"/Worker/Profile";
        		else
        			alert("developer mode upload fail.");
        			//error(data.code);
        	}    
    	});
	});*/

});
