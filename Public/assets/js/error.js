function error(code)
{
	if (code==1)
	{
		alert("unknown error, please report");
		window.location.href=web_url+"/Index/dologout";
	}
	if (code==2)
	{
		alert("internal error, please report");
		window.location.href=web_url+"/Index/dologout";
	}
	if (code==3)
	{
		alert("invalid token, please login");
		var i = window.parent;
		if (i != null)
			i.location.href=web_url+"/Index/dologout";
		else
			window.location.href=web_url+"/Index/dologout";
	}
	if (code==10)
	{
		alert("invalid token, please login");
		window.location.href=web_url+"/Index/dologout";
	}
	if (code==1000)
	{
		alert("param is missing");
	}
	if (code==1001)
	{
		alert("param should be one of");
	}
	if (code==1100)
	{
		alert("post required");
	}
	if (code==1101)
	{
		alert("requester required");
	}
	if (code==1102)
	{
		alert("worker required");
	}
	if (code==1200)
	{
		alert("user exists");
	}
	if (code==1201)
	{
		alert("user doesn't exist");
	}
	if (code==1202)
	{
		alert("invalid password");
	}
	if (code==1300)
	{
		alert("upload file format error");
		window.location.href=web_url+"/Requester/upload_data";
	}
	if (code==1301)
	{
		alert("qualification test isn\'t needed");
	}
	if (code==1302)
	{
		alert("qualification test required");
		window.location.href=web_url+"/Requester/qualificationtest";
	}
	if (code==1303)
	{
		alert("worker forbidden for this task");
	}
	if (code==1304)
	{
		alert("no available units");
	}
	if (code==1305)
	{
		alert("invalid token");
		window.location.href=web_url+"/Index/dologout";
	}
	if (code==1306)
	{
		alert("invalid question id");
	}
	if (code==1307)
	{
		alert("missing answers");
	}
	if (code==1308)
	{
		alert("multiple accesses");
	}
	if (code==1309)
	{
		alert("wrong task status");
		window.location.href=web_url+"/Requester/index";
	}
	if (code==1310)
	{
		alert("money is not enough, please recharge!");
		window.location.href=web_url+"/Requester/Profile";
	}

	if (code==1311)
	{
		alert("price should be larger than 0!");
		window.location.href=web_url+"/Requester/manage_quality";
	}

	if (code==1312)
	{
		alert("no units!");
		var i = window.parent;
		if (i != null)
			i.location.href=web_url+"/Requester/upload_data";
		else
			window.location.href=web_url+"/Requester/upload_data";
		//window.location.href=web_url+"/Requester/upload_data";
	}

	if (code==1400)
	{
		alert("not a zip file.");
		window.location.href=web_url+"/Requester/upload_pic";
	}
	if (code==1401)
	{
		alert("invalid zip file, maybe it contains invalid image, only allow .jpg, .png, jpeg.");
		window.location.href=web_url+"/Requester/upload_pic";
	}
	if (code==1500)
	{
		alert("the request image doesn't exist on server.");
		window.location.href=web_url+"/Requester/upload_pic";
	}

}
