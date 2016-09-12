function init()
{	
	var data = [[2003,10],[2004,11],[2005,21],[2006,21],[2007,12],[2008,12],[2009,32],[2010,12],[2011,12],[2012,4],[2013,12]];
	var key = "Money";
	var color = "black";
	var id = "chart_money";

	if($('#lang').val() == 'en-us') key = "Money";
	else key = "金额";
	changeMoneyChart("day");

	if($('#lang').val() == 'en-us') key = "Task";
	else key = "任务";
	changeTaskChart('day');

	if($('#lang').val() == 'en-us') key = "Unit";
	else key = "单元";
	changeQuestionChart('day');

	$('#money-day-checkbox').click(function(){
		changeMoneyChart("day");
	});
	$('#money-week-checkbox').click(function(){
		changeMoneyChart("week");
	});
	$('#money-month-checkbox').click(function(){
		changeMoneyChart("month");
	});
	$('#money-year-checkbox').click(function(){
		changeMoneyChart("year");
	});

	$('#task-day-checkbox').click(function(){
		changeTaskChart("day");
	});
	$('#task-week-checkbox').click(function(){
		changeTaskChart("week");
	});
	$('#task-month-checkbox').click(function(){
		changeTaskChart("month");
	});
	$('#task-year-checkbox').click(function(){
		changeTaskChart("year");
	});

	$('#question-day-checkbox').click(function(){
		changeQuestionChart("day");
	});
	$('#question-week-checkbox').click(function(){
		changeQuestionChart("week");
	});
	$('#question-month-checkbox').click(function(){
		changeQuestionChart("month");
	});
	$('#question-year-checkbox').click(function(){
		changeQuestionChart("year");
	});
}

function changeMoneyChart(flag)
{	
	var url = api_url+'/stat/requester/'+flag+'?requester_id='+$('#requester_id').val()+'&n_'+flag+'s=10&token='+$('#requester_token').val();
	//console.log(url);

	var key = "Money";
	if($('#lang').val() != "en-us") key = "金额";

	var color = "black";
	if(flag == "month") color = "#238E23";
	else if(flag == "year") color = "#FF7F00";
	else if(flag == "week") color = "#007F00";

	//var data = [[2003,12],[2004,43],[2005,23],[2006,32],[2007,10],[2008,25],[2009,12],[2010,23],[2011,6],[2012,23],[2013,13]];
	//init_chart(data,key,color,'chart_money');
	getDataFromServer(url,key,color,'chart_money','money',flag);
}

function changeTaskChart(flag)
{
	var url = api_url+'/stat/requester/'+flag+'?requester_id='+$('#requester_id').val()+'&n_'+flag+'s=10&token='+$('#requester_token').val();
	//console.log(url);

	var key = "Task";
	if($('#lang').val() != "en-us") key = "任务";

	var color = "black";
	if(flag == "month") color = "#238E23";
	else if(flag == "year") color = "#FF7F00";
	else if(flag == "week") color = "#007F00";
	
	getDataFromServer(url,key,color,'chart_task','finished_tasks',flag);	
}

function changeQuestionChart(flag)
{
	var url = api_url+'/stat/requester/'+flag+'?requester_id='+$('#requester_id').val()+'&n_'+flag+'s=10&token='+$('#requester_token').val();
	//console.log(url);

	var key = "Unit";
	if($('#lang').val() != "en-us") key = "单元";

	var color = "black";
	if(flag == "month") color = "#238E23";
	else if(flag == "year") color = "#FF7F00";
	else if(flag == "week") color = "#007F00";

	getDataFromServer(url,key,color,'chart_question','finished_units',flag);
}

function init_chart(data,key,color,id)
{
	$('svg[id='+id+'] g').remove();

  	var testdata = [{
   		"key" : key,
    	"bar": true,
    	"color": color,
	  	"values": data,	
	},]
	.map(function(series) {
  		series.values = series.values.map(function(d) { return {x: d[0], y: d[1] } });
  		return series;
	});

	var chart;
	nv.addGraph(function() {
	    chart = nv.models.linePlusBarChart()
	        .margin({top: 30, right: 60, bottom: 50, left: 70})
	        .x(function(d,i) { return i })
	        .color(d3.scale.category10().range());

	    chart.xAxis.tickFormat(function(d) {
	      	var dx = testdata[0].values[d] && testdata[0].values[d].x || 0;
	      	return dx;
	      })
	      .showMaxMin(false);

	    if(id == 'chart_money')
	    	chart.y1Axis.tickFormat(d3.format(',.2f'));
	    else chart.y1Axis.tickFormat(d3.format(',.1f'));

	    d3.select('svg[id='+id+']')
	        .datum(testdata)
	      .transition().duration(500).call(chart);

	    nv.utils.windowResize(chart.update);

	    chart.dispatch.on('stateChange', function(e) { nv.log('New State:', JSON.stringify(e)); });
		
		return chart;
	});
}

function getDataFromServer(url,key,color,id,column,flag)
{
	$.ajax({    
        type:'get',        
        url:url,
        dataType: 'json',    
        success:function(jsonObject){
        	
        	if(jsonObject.code != "0"){
        		alert("加载失败");
        		return;
        	}	

        	var data = [];
        	var xAxis = getXAxis(flag);
        	//alert(xAxis.length);
        	//alert(column);
        	if(column == 'finished_tasks')
        		var yAxis = jsonObject.result.published_tasks;
        	else if(column == 'finished_units')
        		var yAxis = jsonObject.result.finished_units;
        	else if(column == 'finished_questions')
        		var yAxis = jsonObject.result.finished_questions;
        	else if(column == 'money')
        		var yAxis = jsonObject.result.money;
        	for(var index in yAxis)
        	{
        		var item = new Array();
        		item.push(xAxis[index]);
        		item.push(yAxis[index]);
        		data.push(item);
        	}
        	init_chart(data,key,color,id);
        },
        error:function(jsonObject){

        },
    });
}

function getXAxis(flag)
{
	var date = new Date();
	var xAxis = new Array();

	for(var i = 0;i < 10;i++)
	{
		if(flag == "year")
			xAxis.push(date.getFullYear()-i);
		else if (flag == "month")
		{	
			var month = date.getMonth()-i+1;
			if(month <= 0) xAxis.push((date.getFullYear()-1).toString()+"."+(month+12).toString());
			else xAxis.push(date.getFullYear().toString()+"."+month.toString());
		}
		else if (flag == "day")
		{	
			var day = date.getDate()-i;
			var month = date.getMonth()+1;
			var year = date.getFullYear();
			if(day > 0) {
				xAxis.push(date.getFullYear().toString()+"."+month.toString()+"."+day.toString());
			}
			else {
				month = date.getMonth()-1;
				if(month == -1) { // 上个月是去年12月
					day = date.getDate()-i+31;
					month = 11;
					year = date.getFullYear()-1;
				}
				else if(month == 0 || month == 2 || month == 4 || month == 6 || month == 7 || month == 9) { // 上个月是1、3、5、7、8、10月
					day = date.getDate()-i+31;
				}
				else if(month == 1) { // 上个月是2月
					if(date.getFullYear() % 4 == 0) { // 闰年
						day = date.getDate()-i+29;
					}
					else { // 普通年份
						day = date.getDate()-i+28;
					}
				}
				else { // 上个月是2、4、6、9、11月
					day = date.getDate()-i+30;
				}
				month = month+1; // 注意月份是0-11
				xAxis.push(year.toString()+"."+month.toString()+"."+day.toString());
			}
		}
		else{
			xAxis.push(i+1);
		}
	}
	return xAxis;
}
