//var filecontent;
//var content = "";
$(document).ready(function() {
	//var pics = 0;

	$.post(web_url+'/Requester/getjobstatus', {}, 
		function(data, status) {
			if (status=="success")
			{
				if (data['status']=="init")
				{
					alert(display_lang["you need to build your task!"]);
					window.location.href = web_url + "/Requester/build_job";
				}
				else if (data['status']=="publish")
				{
					alert(display_lang["you have already published your task!"]);
					window.location.href = web_url+ "/Requester/monitor";
				}
			}
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

	$("#button_new").click(function(){
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
		$("#data_up").ajaxSubmit({
			"success":function(data) {
				console.log(data);
				if (data.code==0)
				{
					alert(display_lang["data upload success!"]);
					//alert(JSON.stringify(data));
					window.location.href = web_url+'/Requester/preview';
				}
				else
				{
					error(data.code);
				}
			}
		});
	});

	/*$("#button_new_pic").click(function(){
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
		/*$("#pic_up").ajaxSubmit({
			"success":function(data) {
				console.log(data);
				alert("pic upoad success.");
				content = "";
				var template_id = $("#template_id").val();
				if (template_id=="3")
				{
					for (var i = 0; i < data["result"].length; i++)
					{
						content += data["result"][i];
						content += "\n";
					}
				}
				else if (template_id=="4")
				{
					for (var i = 0; i < data["result"].length; i=i+2)
					{
						content += data["result"][i];
						content += "***"
						content += data["result"][i+1];
						content += "\n";
					}
				}
				//SaveAs(content);
				/*saveAs(
		  			new Blob(
			  			[content]
						, {type: "text/plain;charset=" + document.characterSet}
					)
					, "pic_url"
				);*/
				//window.location.href = web_url+'/Requester/preview';
			/*}
		});
	});*/

	/*$("#pic_url_file").click(function(){
		if (content=="")
		{
			alert("No pic uploaded, No url file to download");
		}
		else
		{
			SaveAs(content);
		}
	});*/

});

/*function SaveAs(content)
{
      //var content = midrecon(number);
      //content = encodeToGb2312(content);
      var blob = new Blob([content], {type: "text/plain;charset=" + document.characterSet});
      var type = blob.type;
      var force_saveable_type = 'application/octet-stream';
      if (type && type != force_saveable_type) { // 强制下载，而非在浏览器中打开
        var slice = blob.slice || blob.webkitSlice || blob.mozSlice;
        blob = slice.call(blob, 0, blob.size, force_saveable_type);
      } 
      var url = URL.createObjectURL(blob);
      var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
      save_link.href = url;
      save_link.download = "pic_url"; 
      var event = document.createEvent('MouseEvents');
      event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
      save_link.dispatchEvent(event);
      URL.revokeObjectURL(url);
}*/
