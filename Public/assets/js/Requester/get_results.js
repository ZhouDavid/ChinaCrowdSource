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
        else if (data['status']=="data")
        {
          alert(display_lang["you need to publish your task!"]);
          window.location.href = web_url+ "/Requester/launch";
        }
      }
    });

$('#get_results').click(function() {
	//window.location.href = web_url + "/Requester/build_job";
	var data = {};
	data['task_id'] = $("#task_id").val();
	$.ajax({
		type: 'post',
		url: api_url+'/workflow/download_answer/?token='+$("#requester_token").val(),
		data: data,
		success: function(data) {
			//alert(data);
			SaveAs(data);
		}
	});
});

});

function SaveAs(content)
{
      //var content = midrecon(number);
      //content = encodeToGb2312(content);
      var blob = new Blob([content], {type: 'text/plain'});
      var type = blob.type;
      var force_saveable_type = 'application/octet-stream';
      if (type && type != force_saveable_type) { // 强制下载，而非在浏览器中打开
        var slice = blob.slice || blob.webkitSlice || blob.mozSlice;
        blob = slice.call(blob, 0, blob.size, force_saveable_type);
      } 
      var url = URL.createObjectURL(blob);
      var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
      save_link.href = url;
      save_link.download = "result.csv"; 
      var event = document.createEvent('MouseEvents');
      event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
      save_link.dispatchEvent(event);
      URL.revokeObjectURL(url);
}
