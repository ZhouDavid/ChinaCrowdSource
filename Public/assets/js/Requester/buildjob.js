$(document).ready(function() {
	//document.getElementById("modify").innerText = "Build Task: Click on the sections to the right to complete these 3 steps of building task:Add Title and Instructions - please write a clear title and instructions for contributors. Unit description - if you added source data, this is where you show it in your job.Add questions - these are the questions you want contributors to answer.";

	var editor = null;
	
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

	var hashtemplate = {
			"please answer the following questions about apple":"请回答下面关于苹果的问题",
			"please answer the following questions about banana":"请回答下面关于香蕉的问题",
			"please answer the following questions about orange":"请回答下面关于桔子的问题",
			"please answer the following questions about {fruit}":"请回答下面关于 {fruit} 的问题",
			"please compare Apple and Banana, and answer the following questions.":"请比较苹果和香蕉，并回答下面的问题。",
			"please compare {fruit1} and {fruit2}, and answer the following questions.":"请比较 {fruit1} 和 {fruit2} ，并回答下面的问题。",
			"please answer the following questions about picture url@{url_of_pic}@.":"请回答下面关于图 url@{url_of_pic}@ 的问题。",
			"please compare picture url@{url_of_pic1}@ and picture url@{url_of_pic2}@, and answer the following questions.":"请比较图 url@{url_of_pic1}@ 和图 url@{url_of_pic2}@ ，并回答以下问题。",
			"please answer the following questions about webpage web@crowdbao{html}crowdbao@.":"请回答下面关于网页 web@crowdbao{html}crowdbao@ 的问题。",
			"please compare webpages web@crowdbao{html1}crowdbao@ and web@crowdbao{html2}crowdbao@, and answer the following questions.":"请比较网页 web@crowdbao{html1}crowdbao@ 和网页 web@crowdbao{html2}crowdbao@ ，并回答以下问题。",
			"choose the color":"选择颜色",
			"red":"红色",
			"orange":"橙色",
			"yellow":"黄色",
			"choose the category(multiple choices)":"选择种类（可多选）",
			"fruit":"水果",
			"vegetable":"蔬菜",
			"input the chinese name":"输入中文名字",
			"choose the precision of the webpage content.":"选择网页内容的准确性。",
			"choose the category of the webpage(multiple choices).":"选择网页种类（可多选）。",
			"input the evaluation of the webpage.":"输入对网页的评价。",
			"accurate":"准确",
			"moderate":"中等",
			"inaccurate":"不准确",
			"science":"科学",
			"nature":"自然",
			"choose the source of the entity.":"选择实体的来源。",
			"choose the property of the entity(multiple choices).":"选择实体属性（可多选）。",
			"input the evaluation of the entity.":"输入对实体的评价。",
			"baidu":"baidu",
			"wiki":"wiki",
			"google":"google",
			"life":"生命",
			"hard":"硬"
	};

	$('#show_your_data').summernote({
		height: 150,
  		toolbar: [
    	['style', ['style']], // no style button
    	['style', ['bold', 'italic', 'underline', 'clear']],
    	['fontname', ['fontname']],
    	['color', ['color']],
    	['para', ['ul', 'ol', 'paragraph']],
    	['height', ['height']],
    	['view', ['fullscreen', 'codeview']]
    	//['insert', ['picture', 'link']], // no insert buttons
    	//['table', ['table']], // no table button
    	//['help', ['help']] //no help button
  		],
  		codemirror: {
  			theme: "3024-night",
    		height: "150px",
    		mode: "text/html",
    		lineNumbers: true
  		},
  		onfocus: function(e) {
			//console.log('Editable area is focused');
			document.getElementById("modify").innerText = "";
			$(".selected").removeClass("selected");
			$(this).addClass("selected");
		}
	});

	$('#job_title').focus(function() {
		document.getElementById("modify").innerText = "";
		$(".selected").removeClass("selected");
		$(this).addClass("selected");
	});

	$('#job_description').focus(function() {
		document.getElementById("modify").innerText = "";
		$(".selected").removeClass("selected");
		$(this).addClass("selected");
	});

	$('#switch_to_html').click(function() {
		var content_html = $('#show_your_data').code();
		$('#show_your_data').destroy();
		var textarea = document.getElementById('show_your_data');
		textarea.value = content_html;
  		editor = CodeMirror.fromTextArea(textarea, {
  			//content: content_html,
  			theme: "3024-night",
    		height: "150px",
    		mode: "text/html",
    		//content: content_html,
    		lineNumbers: true,
    		indentWithTabs: true,  
        	smartIndent: true,    
        	matchBrackets: true, 
    		lineWrapping: true
  		});
  		$('#switch_to_graph').css("display", "block");
		$(this).css("display", "none");
	});

	$('#switch_to_graph').click(function() {
		editor.toTextArea();
		$('#show_your_data').summernote({
			height: 150,
  			toolbar: [
    			['style', ['style']], // no style button
    			['style', ['bold', 'italic', 'underline', 'clear']],
    			['fontname', ['fontname']],
    			['color', ['color']],
    			['para', ['ul', 'ol', 'paragraph']],
    			['height', ['height']],
    			['view', ['fullscreen', 'codeview']]
    			//['insert', ['picture', 'link']], // no insert buttons
    			//['table', ['table']], // no table button
    			//['help', ['help']] //no help button
  			],
  			codemirror: {
  				theme: "3024-night",
    			height: "150px",
    			mode: "text/html",
    			lineNumbers: true,
  			},
  			onfocus: function(e) {
				//console.log('Editable area is focused');
				document.getElementById("modify").innerText = "";
				$(".selected").removeClass("selected");
				$(this).addClass("selected");
			}
		});
		editor = null;
		$('#switch_to_html').css("display", "block");
		$(this).css("display", "none");
	});

	/*$('#show_your_data').focus(function(){
		document.getElementById("modify").innerText = "";
		$(".selected").removeClass("selected");
		$(this).addClass("selected");
	});*/

	var hash = {"Technology":"科技","Life":"生活","Entertainment":"休闲","Sports":"运动","Education":"教育","Health":"健康"};			
	$.ajax({
		type:'get',
		url:api_url+'/tag/?token='+$('#requester_token').val(),
		dataType: 'json',
		success:function(data)
		{
			//alert(JSON.stringify(data));
			//alert(document.getElementsByClassName("lang")[0].name);
			var len = data.length;
			var ylen = len%3;
			var blen = (len-ylen)/3;
			var len1 = blen+(ylen>1?1:ylen);
			var len2 = blen+(ylen>1?1:0);
			var len3 = blen;
			//alert(len);
			//alert(ylen);
			//alert(blen);
			//alert(len1);
			//alert(len2);
			//alert(len3);
			for (var i = 0; i < len; i++)
			{
				var div = document.createElement("div");
				var input = document.createElement("input");
				input.type = "checkbox";
				input.name = "interest";
				input.value = data[i]["id"];
				var label = document.createElement("label");
				var text = (document.getElementsByClassName("lang")[0].name != 'en-us' ? data[i]['description'] : hash[data[i]['description']]);
				label.innerText = text;
				div.appendChild(input);
				div.appendChild(label);
				div.className = "checkbox-inline margin-left-10";

				if(i < len1)
					$('#interest-first-column').append($(div));
				else if(i < (len2+len1) && i >= len1)
					$('#interest-second-column').append($(div));
				else $('#interest-third-column').append($(div));

				//document.getElementById("task_tags").appendChild(div);
			}

			$.post(web_url+'/Requester/get_job_tags', {},
				function(data, status) {
					if (status=="success")
					{
						//alert(JSON.stringify(data));
						for (var i = 0; i < data.length; i++)
						{
							$('input[name=interest]').get(data[i]-1).checked = true;
						}
					}
				});
		}
	});

	var question_template = {};

	$.post(web_url+'/Requester/build_job_template', {},
		function(data, status) {
			if (status="success")
			{
				if (data["template"] == null)
				{
					error(3);
				}
				if (data["template"]["code"] != 0)
				{
					error(data["template"]["code"]);
				}

				if ($("#template_id").val()=="5")
				{
					//data["template"]["result"]["format"][i]["description"] = "please answer the following questions about webpage web@crowdbao{html}crowdbao@.";
						var lenq = data["template"]["result"]["format"][0]["questions"].length;
						for (var j = 0; j < lenq; j++)
						{
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-radio"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "choose the precision of the webpage content.";
								var options = new Array("accurate", "moderate", "inaccurate");
								data["template"]["result"]["format"][0]["questions"][j]["options"] = options;
							}
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-checkbox"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "choose the category of the webpage(multiple choices).";
								var options = new Array("science", "nature");
								data["template"]["result"]["format"][0]["questions"][j]["options"] = options;
							}
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-input"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "input the evaluation of the webpage.";
							}
						}
				}
				else if ($("#template_id").val()=="6")
				{
					//data["template"]["result"]["format"][i]["description"] = "please compare webpages web@crowdbao{html1}crowdbao@ and web@crowdbao{html2}crowdbao@, and answer the following questions.";
					//if (i==0)
					//{
						var lenq = data["template"]["result"]["format"][0]["questions"].length;
						for (var j = 0; j < lenq; j++)
						{
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-radio"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "choose the precision of the webpage content.";
								var options = new Array("accurate", "moderate", "inaccurate");
								data["template"]["result"]["format"][0]["questions"][j]["options"] = options;
							}
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-checkbox"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "choose the category of the webpage(multiple choices).";
								var options = new Array("science", "nature");
								data["template"]["result"]["format"][0]["questions"][j]["options"] = options;
							}
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-input"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "input the evaluation of the webpage.";
							}
						}
					//}
				}
				else if ($("#template_id").val()=="7")
				{
					//data["template"]["result"]["format"][i]["description"] = "please classify the apple and answer the following questions.";
					//if (i==0)
					//{
						var lenq = data["template"]["result"]["format"][0]["questions"].length;
						for (var j = 0; j < lenq; j++)
						{
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-radio"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "choose the source of the entity.";
								var options = new Array("baidu", "wiki", "google");
								data["template"]["result"]["format"][0]["questions"][j]["options"] = options;
							}
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-checkbox"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "choose the property of the entity(multiple choices).";
								var options = new Array("life", "hard");
								data["template"]["result"]["format"][0]["questions"][j]["options"] = options;
							}
							if (data["template"]["result"]["format"][0]["questions"][j].hasOwnProperty("type-input"))
							{
								data["template"]["result"]["format"][0]["questions"][j]["description"] = "input the evaluation of the entity.";
							}
						}
					//}
				}

				var lang = document.getElementsByClassName("lang")[0].name;
				if (lang == 'en-us')
				{
					var len = data["template"]["result"]["format"].length;
					for (var i = 0; i < len; i++)
							{
								data["template"]["result"]["format"][i]["description"] = hashtemplate[data["template"]["result"]["format"][i]["description"]];
								if (i==0)
								{
									var queslen = data["template"]["result"]["format"][i]["questions"].length;
									for (var j = 0; j < queslen; j++)
									{
										data["template"]["result"]["format"][i]["questions"][j]["description"] = hashtemplate[data["template"]["result"]["format"][i]["questions"][j]["description"]];
										if (!data["template"]["result"]["format"][i]["questions"][j].hasOwnProperty("type-input"))
										{
											var oplen = data["template"]["result"]["format"][i]["questions"][j]["options"].length;
											for (var k = 0 ; k < oplen; k++)
											{
												data["template"]["result"]["format"][i]["questions"][j]["options"][k] = hashtemplate[data["template"]["result"]["format"][i]["questions"][j]["options"][k]];
											}
										}
									}
								}
							}
					if ($("#status").val() == "init")
					{
						$("#show_your_data").code(hashtemplate[$("#show_your_data").code()]);
					}
				}



				//alert(JSON.stringify(data));
				var questions = data["template"]["result"]["format"][0]["questions"];

				for (var i = 0; i < questions.length; i++)
				{
					if (questions[i].hasOwnProperty("type-radio"))
					{
						question_template["radio"] = questions[i];
					}
					else if (questions[i].hasOwnProperty("type-input"))
					{
						question_template["text"] = questions[i];
					}
					else
					{
						question_template["checkbox"] = questions[i];
					}
				}

				if (data.hasOwnProperty("option"))
				{
					if (data["option"]== null)
					{
						error(1309);
					}
					if (data["option"]['code'] != 0)
					{
						error(data["option"]['code']);
					}
					questions = data["option"]['result']['option']["questions"];
				}
				if ($("#template_id").val()=="7")
				{
					var classification = document.createElement("div");
					classification.className = "question";
					$(classification).jstree({
    									'core' : {
											'data' : {
												"url" : "../../Public/assets/json/root.json",
												"dataType" : "json"
											}
    									}
  									});
					$("#questions").prepend(classification);
				}

				//question_template = questions[0];
				for (var i = 0; i < questions.length; i++) {
					var question = document.createElement("div");
					question.className = "question";
					var question_des = document.createElement("div");
					question_des.innerText = questions[i]["description"];
					question_des.className = "question_des";
					question.appendChild(question_des);
					var type = document.createElement("div");
					if (questions[i].hasOwnProperty("type-radio"))
					{
						type.className = "typeradio";
					}
					else if (questions[i].hasOwnProperty("type-input"))
					{
						type.className = "typetext";
					}
					else
					{
						type.className = "typecheckbox";
					}
					if (questions[i].hasOwnProperty("options"))
					{
						//type.className = "choose";
						var options = questions[i]["options"];
						for (var j = 0; j < options.length; j++)
						{
							var option = document.createElement("div");
							option.className = "option";
							var input = document.createElement("input");
							if (questions[i]["type-radio"] == 1)
								input.type = "radio";
							else
							{
								input.type = "checkbox";
							}
							input.name = questions[i]["name"];
							input.value = options[j];
							option.appendChild(input);
							var text = document.createElement("label");
							text.innerText = options[j];
							option.appendChild(text);
							type.appendChild(option);
						}
					}
					else {
						//type.className = "text";
						var option = document.createElement("div");
						option.className = "option";
						var input = document.createElement("input");
						input.type = "text";
						input.className = "input_b";
						input.name = questions[i]["name"];
						option.appendChild(input);
						type.appendChild(option);
					}
					question.appendChild(type);
					document.getElementById("questions").appendChild(question);

					var control = document.createElement("div");
					control.className = "control";
					var span = document.createElement("span");
					span.className = "glyphicon glyphicon-remove";
					control.appendChild(span);
					question.appendChild(control);
					$(control).click(function(){
						if ($(this).parent().next().length != 0)
						{
							$(this).parent().next().click();
						}
						else if ($(this).parent().prev().length != 0)
						{
							$(this).parent().prev().click();
						}
						else {
							$(".editpad").remove();
						}
						$(this).parent().remove();
					});

					$(question).click(function(){
						$(".selected").removeClass("selected");
						$(this).addClass("selected");
						var linkname = $(this).children().eq(1).attr("class");
						linkname += "link";
						//alert(linkname);
						$("#link").val(linkname);
						var modify = document.getElementById("modify");
						modify.innerText = "";

						var fields = document.createElement("div");
						fields.id = "fields";
						fields.className = "field";
						var ul = document.createElement("ul");
						var li1 = document.createElement("li");
						var a1 = document.createElement("a");
						a1.className = "typetextlink";
						var text_t = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Line Text" : "填空");
						a1.innerText = text_t;
						li1.appendChild(a1);
						ul.appendChild(li1);
						var li2 = document.createElement("li");
						var a2 = document.createElement("a");
						a2.className = "typecheckboxlink";
						a2.innerText = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Checkbox" : "多选");

						li2.appendChild(a2);
						ul.appendChild(li2);
						var li3 = document.createElement("li");
						var a3 = document.createElement("a");
						a3.className = "typeradiolink";
						a3.innerText = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Radio" : "单选");

						li3.appendChild(a3);
						ul.appendChild(li3);
						$(a1).click(function(){
   							//$("#alertDiv").show();
   							$("#link").val("typetextlink");
   							$('#add_question').click();
   		
   							//$(".white:last").empty();
  						});

  						$(a2).click(function(){
   							//$("#alertDiv").show();
   							$("#link").val("typecheckboxlink");
   							$('#add_question').click();
   		
   							//$(".white:last").empty();
  						});
  						$(a3).click(function(){
   							//$("#alertDiv").show();
   							$("#link").val("typeradiolink");
   							$('#add_question').click();
  						});
						fields.appendChild(ul);
						modify.appendChild(fields);

						var div = document.createElement("div");
						div.className = "editpad";
						var div_title = document.createElement("div");
						var titlelabel = document.createElement("label");
						titlelabel.innerText = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Question Description:" : "问题描述：");

						div_title.appendChild(titlelabel);
						var input = document.createElement("input");
						input.type = "text";
						//input.className = "question_des_value";
						var question_des = $(this)[0].getElementsByClassName("question_des");
						input.value = question_des[0].innerText;
						input.className = "input_question_des";
						$(input).bind('input propertychange', function() {
    						//$('#content').html($(this).val().length + ' characters');
    						$(".selected")[0].getElementsByClassName("question_des")[0].innerText = $(this).val();
						});
						div_title.appendChild(input);
						div.appendChild(div_title);

						if ($(this)[0].getElementsByTagName("div")[1].className == "typeradio"){

							var div_radios = document.createElement("div");
							div_radios.id = "div_radios";

							var options = $(this)[0].getElementsByTagName("input");
							for (var i = 0; i < options.length; i++)
							{
								var divradio = document.createElement("div");
								var radio = document.createElement("input");
								radio.type = "radio";
								//radio.value = options[i].value;
								divradio.appendChild(radio);
								var text = document.createElement("input");
								text.type = "text";
								text.value = options[i].value;
								text.className = "radio_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divradio.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divradio.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});


								div_radios.appendChild(divradio);
							}

							div.appendChild(div_radios);
							var button = document.createElement("button");
							button.className = "new-button lightblue";
							button.innerText = "add a radio";
							$(button).click(function(){

								var type = $(".selected")[0].getElementsByTagName("div")[1];
								var option = document.createElement("div");
								option.className = "option";
								var input = document.createElement("input");
								input.type = "radio";
								input.name = type.getElementsByClassName("option")[0].getElementsByTagName("input").name;
								//input.value = options[j];
								option.appendChild(input);
								var text = document.createElement("label");
								//text.innerText = options[j];
								option.appendChild(text);
								type.appendChild(option);

								var divradio = document.createElement("div");
								var radio = document.createElement("input");
								radio.type = "radio";
								//radio.value = options[i].value;
								divradio.appendChild(radio);
								var text = document.createElement("input");
								text.type = "text";
								text.className = "radio_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divradio.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divradio.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});

								document.getElementById("div_radios").appendChild(divradio);
							});
							div.appendChild(button);
							li3.appendChild(div);
						}
						else if ($(this)[0].getElementsByTagName("div")[1].className == "typecheckbox")
						{
							var div_checkboxs = document.createElement("div");
							div_checkboxs.id = "div_checkboxs";

							var options = $(this)[0].getElementsByTagName("input");
							for (var i = 0; i < options.length; i++)
							{
								var divcheckbox = document.createElement("div");
								var checkbox = document.createElement("input");
								checkbox.type = "radio";
								//radio.value = options[i].value;
								divcheckbox.appendChild(checkbox);
								var text = document.createElement("input");
								text.type = "text";
								text.value = options[i].value;
								text.className = "checkbox_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divcheckbox.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divcheckbox.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});

								div_checkboxs.appendChild(divcheckbox);
							}

							div.appendChild(div_checkboxs);
							var button = document.createElement("button");
							button.className = "new-button lightblue";
							button.innerText = "add a checkbox";
							$(button).click(function(){

								var type = $(".selected")[0].getElementsByTagName("div")[1];
								var option = document.createElement("div");
								option.className = "option";
								var input = document.createElement("input");
								input.type = "checkbox";
								input.name = type.getElementsByClassName("option")[0].getElementsByTagName("input").name;
								//input.value = options[j];
								option.appendChild(input);
								var text = document.createElement("label");
								//text.innerText = options[j];
								option.appendChild(text);
								type.appendChild(option);

								var divcheckbox = document.createElement("div");
								var checkbox = document.createElement("input");
								checkbox.type = "radio";
								//radio.value = options[i].value;
								divcheckbox.appendChild(checkbox);
								var text = document.createElement("input");
								text.type = "text";
								text.className = "checkbox_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divcheckbox.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divcheckbox.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});

								document.getElementById("div_checkboxs").appendChild(divcheckbox);
							});
							div.appendChild(button);
							li2.appendChild(div);
						}
						else {
							li1.appendChild(div);
						}
					});
				}
			}
		});

	$('#add_question').click(function(){

		if ($("#link").val() == "typetextlink")
		{
			question_template_add = question_template["text"];
		}
		else if($("#link").val() == "typecheckboxlink")
		{
			question_template_add = question_template["checkbox"];
		}
		else
		{
			question_template_add = question_template["radio"];
		}
		var question = document.createElement("div");
		question.className = "question white";
		var question_des = document.createElement("div");
		question_des.innerText = question_template_add["description"];
		question_des.className = "question_des";
		question.appendChild(question_des);
		var type = document.createElement("div");
		if ($("#link").val() == "typetextlink")
		{
			type.className = "typetext";
		}
		else if($("#link").val() == "typecheckboxlink")
		{
			type.className = "typecheckbox";
		}
		else
		{
			type.className = "typeradio";
		}

		if ($("#link").val() != "typetextlink"){
			//var type = document.createElement("div");
			//type.className = "typeradio";
			var options = question_template_add["options"];
			for (var j = 0; j < options.length; j++)
			{
				var option = document.createElement("div");
				option.className = "option";
				var input = document.createElement("input");
				//input.type = "radio";
				if (question_template_add["type-radio"] == 1)
					input.type = "radio";
				else
				{
					input.type = "checkbox";
				}
				input.name = question_template_add["name"];
				input.value = options[j];
				option.appendChild(input);
				var text = document.createElement("label");
				text.innerText = options[j];
				option.appendChild(text);
				type.appendChild(option);
			}
		}
		else {
			//type.className = "text";
			var option = document.createElement("div");
			option.className = "option";
			var input = document.createElement("input");
			input.type = "text";
			input.className = "input_b";
			input.name = question_template_add["name"];
			option.appendChild(input);
			type.appendChild(option);
		}
		question.appendChild(type);
		document.getElementById("questions").appendChild(question);

		var control = document.createElement("div");
		control.className = "control";
		var span = document.createElement("span");
		span.className = "glyphicon glyphicon-remove";
		control.appendChild(span);
		question.appendChild(control);
		$(control).click(function(){
			if ($(this).parent().next().length != 0)
			{
				$(this).parent().next().click();
			}
			else if ($(this).parent().prev().length != 0)
			{
				$(this).parent().prev().click();
			}
			else {
				$(".editpad").remove();
			}
			$(this).parent().remove();
		});

		$(question).click(function(){
			$(".selected").removeClass("selected");
			$(this).addClass("selected");
			var linkname = $(this).children().eq(1).attr("class");
			linkname += "link";
			//alert(linkname);
			$("#link").val(linkname);
			var modify = document.getElementById("modify");
			modify.innerText = "";

			var fields = document.createElement("div");
			fields.id = "fields";
			fields.className = "field";
			var ul = document.createElement("ul");
			var li1 = document.createElement("li");
			var a1 = document.createElement("a");
			a1.className = "typetextlink";
			a1.innerText = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Line Text" : "填空");

			li1.appendChild(a1);
			ul.appendChild(li1);
			var li2 = document.createElement("li");
			var a2 = document.createElement("a");
			a2.className = "typecheckboxlink";
			a2.innerText = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Checkbox" : "多选");

			li2.appendChild(a2);
			ul.appendChild(li2);
			var li3 = document.createElement("li");
			var a3 = document.createElement("a");
			a3.className = "typeradiolink";
			a3.innerText = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Radio" : "单选");

			li3.appendChild(a3);
			ul.appendChild(li3);
			$(a1).click(function(){
   				//$("#alertDiv").show();
   				$("#link").val("typetextlink");
   				$('#add_question').click();
   		
   				//$(".white:last").empty();
  			});

  			$(a2).click(function(){
   							//$("#alertDiv").show();
   							$("#link").val("typecheckboxlink");
   							$('#add_question').click();
   		
   							//$(".white:last").empty();
  			});
  			$(a3).click(function(){
   							//$("#alertDiv").show();
   							$("#link").val("typeradiolink");
   							$('#add_question').click();
  			});
			fields.appendChild(ul);
			modify.appendChild(fields);

			var div = document.createElement("div");
			div.className = "editpad";
			var div_title = document.createElement("div");
			var titlelabel = document.createElement("label");
			titlelabel.innerText = (document.getElementsByClassName("lang")[0].name != 'en-us' ? "Question Description:" : "问题描述：");

			div_title.appendChild(titlelabel);
			var input = document.createElement("input");
			input.type = "text";
			//input.className = "question_des_value";
			var question_des = $(this)[0].getElementsByClassName("question_des");
			input.value = question_des[0].innerText;
			input.className = "input_question_des";
			$(input).bind('input propertychange', function() {
    			//$('#content').html($(this).val().length + ' characters');
    			$(".selected")[0].getElementsByClassName("question_des")[0].innerText = $(this).val();
			});
			div_title.appendChild(input);
			div.appendChild(div_title);

						if ($(this)[0].getElementsByTagName("div")[1].className == "typeradio"){

							var div_radios = document.createElement("div");
							div_radios.id = "div_radios";

							var options = $(this)[0].getElementsByTagName("input");
							for (var i = 0; i < options.length; i++)
							{
								var divradio = document.createElement("div");
								var radio = document.createElement("input");
								radio.type = "radio";
								//radio.value = options[i].value;
								divradio.appendChild(radio);
								var text = document.createElement("input");
								text.type = "text";
								text.value = options[i].value;
								text.className = "radio_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divradio.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divradio.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});

								div_radios.appendChild(divradio);
							}

							div.appendChild(div_radios);
							var button = document.createElement("button");
							button.className = "new-button lightblue";
							button.innerText = "add a radio";
							$(button).click(function(){

								var type = $(".selected")[0].getElementsByTagName("div")[1];
								var option = document.createElement("div");
								option.className = "option";
								var input = document.createElement("input");
								input.type = "radio";
								input.name = type.getElementsByClassName("option")[0].getElementsByTagName("input").name;
								//input.value = options[j];
								option.appendChild(input);
								var text = document.createElement("label");
								//text.innerText = options[j];
								option.appendChild(text);
								type.appendChild(option);

								var divradio = document.createElement("div");
								var radio = document.createElement("input");
								radio.type = "radio";
								//radio.value = options[i].value;
								divradio.appendChild(radio);
								var text = document.createElement("input");
								text.type = "text";
								text.className = "radio_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divradio.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divradio.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});

								document.getElementById("div_radios").appendChild(divradio);
							});
							div.appendChild(button);
							li3.appendChild(div);
						}
						else if ($(this)[0].getElementsByTagName("div")[1].className == "typecheckbox")
						{
							var div_checkboxs = document.createElement("div");
							div_checkboxs.id = "div_checkboxs";

							var options = $(this)[0].getElementsByTagName("input");
							for (var i = 0; i < options.length; i++)
							{
								var divcheckbox = document.createElement("div");
								var checkbox = document.createElement("input");
								checkbox.type = "radio";
								//radio.value = options[i].value;
								divcheckbox.appendChild(checkbox);
								var text = document.createElement("input");
								text.type = "text";
								text.value = options[i].value;
								text.className = "checkbox_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divcheckbox.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divcheckbox.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});

								div_checkboxs.appendChild(divcheckbox);
							}

							div.appendChild(div_checkboxs);
							var button = document.createElement("button");
							button.className = "new-button lightblue";
							button.innerText = "add a checkbox";
							$(button).click(function(){

								var type = $(".selected")[0].getElementsByTagName("div")[1];
								var option = document.createElement("div");
								option.className = "option";
								var input = document.createElement("input");
								input.type = "checkbox";
								input.name = type.getElementsByClassName("option")[0].getElementsByTagName("input").name;
								//input.value = options[j];
								option.appendChild(input);
								var text = document.createElement("label");
								//text.innerText = options[j];
								option.appendChild(text);
								type.appendChild(option);

								var divcheckbox = document.createElement("div");
								var checkbox = document.createElement("input");
								checkbox.type = "radio";
								//radio.value = options[i].value;
								divcheckbox.appendChild(checkbox);
								var text = document.createElement("input");
								text.type = "text";
								text.className = "checkbox_value";
								$(text).bind('input propertychange', function() {
    								//$('#content').html($(this).val().length + ' characters');
    								var No = $(this).parent().index();
    								var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
    								div.getElementsByTagName("label")[0].innerText = $(this).val();
    								div.getElementsByTagName("input")[0].value = $(this).val();
								});
								divcheckbox.appendChild(text);

								//var minus = document.createElement("div");
								var span = document.createElement("span");
								span.className = "glyphicon glyphicon-remove";
								//minus.appendChild(span);
								divcheckbox.appendChild(span);
								$(span).click(function(){
									var No = $(this).parent().index();
									var div = $(".selected")[0].getElementsByTagName("div")[1].getElementsByClassName("option")[No];
									$(div).remove();
									$(this).parent().remove();
								});

								document.getElementById("div_checkboxs").appendChild(divcheckbox);
							});
							div.appendChild(button);
							li2.appendChild(div);
						}
						else {
							li1.appendChild(div);
						}
		});
		$(question).click();
	});

	/*$('#save_tags').click(function(){
		var data = {};
		var interest = new Array();
		$('input:checkbox[name=interest]:checked').each(function(){
			interest.push(parseInt($(this).val()));
		});
		alert(interest);
		data["tags"] = interest;
		alert(JSON.stringify(data));

		$.ajax(api_url+'/task/'+$('#task_id').val()+'/?token='+$('#requester_token').val(),{    
        	"type":"PATCH", 
        	traditional: true, // 支持传输组
        	"data":data,        
        	success:function(data){
        		alert(JSON.stringify(data));
        		alert('tags upload success!');
        		//location.href = web_url+"/Worker/Profile";
        	}    
    	});
	});*/

	$('#save').click(function(){

		/*var data = {};
		var interest = new Array();
		$('input:checkbox[name=interest]:checked').each(function(){
			interest.push(parseInt($(this).val()));
		});
		alert(interest);
		data["tags"] = interest;
		alert(JSON.stringify(data));

		$.ajax(api_url+'/task/'+$('#task_id').val()+'/?token='+$('#requester_token').val(),{    
        	"type":"PATCH", 
        	traditional: true, // 支持传输组
        	"data":data,        
        	success:function(data){
        		alert(JSON.stringify(data));
        		alert('tags upload success!');
        		//location.href = web_url+"/Worker/Profile";
        	}    
    	});*/

		var data = {};
		var interest = new Array();
		$('input:checkbox[name=interest]:checked').each(function(){
			interest.push(parseInt($(this).val()));
		});
		//alert(interest);
		if (interest.length==0)
		{
			alert(display_lang["Please choose one tag at least!"]);
			return;
		}
		data["tags"] = interest;
		data["title"] = $("#job_title").val();
		data["description"] = $("#job_description").val();
		//alert(JSON.stringify(data));
		$.ajax(api_url+'/task/'+$('#task_id').val()+'/?token='+$('#requester_token').val(),{    
        	"type":"PATCH", 
        	traditional: true, // 支持传输组
        	"data":data,        
        	success:function(data){
        		//alert(JSON.stringify(data));
        		if (data.code==0)
        			alert(display_lang['title, des and tags upload success!']);
        		//location.href = web_url+"/Worker/Profile";
        		else
        			error(data.code);
        	}    
    	});

		var json = {};
		//var template = $('#show_your_data').code();//$("#show_your_data")[0].value;

		if($("#switch_to_graph")[0].style.display=="none")
		{
			template = $('#show_your_data').code();
		}
		else
		{
			editor.toTextArea();
			template = editor.getTextArea().value;
		}
		template = template.split('\r\n').join('');
		template = template.split('\n').join('');
		console.log(template);

		json["template"] = template;
		console.log(json);
		var questions = new Array();
		var temp = document.getElementsByClassName("question");
		var len = temp.length;
		var begin;
		if ($("#template_id").val()=="7")
		{
			begin = 1;
			var tree = {};
			tree["type-classification"] = 1;
			questions.push(tree);
		}
		else
		{
			begin = 0;
		}
		for (var i = begin; i < len; i++)
		{
			 var divs = temp[i].getElementsByTagName("div");
			 var question = {};
			 question["description"] = divs[0].innerText;
			 if (divs[1].className == "typetext")
			 {
			 	question["type-input"] = 1;
			 }
			 else
			 {
			 	var optionsdiv =  divs[1].getElementsByClassName("option");
			 	var len_s = optionsdiv.length;
			 	var options = new Array();
			 	for (var j = 0; j < len_s; j++)
			 	{
			 		var inputs = optionsdiv[j].getElementsByTagName("input");
			 		options.push(inputs[0].value);
			 	}
			 	question["options"] = options;
			 	if(divs[1].className == "typeradio")
			 	{
			 		question["type-radio"] = 1;
			 	}
			 	else
			 	{
			 		question["type-checkbox"] = 1;
			 	}
			 }
			 //question["type-radio"] = 1;
			 questions.push(question);
		}
		json["questions"] = questions;
		//alert(JSON.stringify(json));
		$.post(
			web_url + '/Requester/uploadoption',
			{
				option: json,
				title: $("#job_title").val(),
				description: $("#job_description").val()
			},
			function(data, status)
			{
				if (status="success")
				{
					if (data.code==0)
					{
						//alert("task create!");
						window.location.href = web_url + "/Requester/upload_data";
					}
					else
					{
						error(data.code);
					}
				}
			});
	});
});
