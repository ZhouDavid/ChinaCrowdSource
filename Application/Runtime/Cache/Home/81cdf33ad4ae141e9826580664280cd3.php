<?php if (!defined('THINK_PATH')) exit();?><body role="document">
<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">
  <head>
   <!--<script type="text/javascript" src="http://www.youziku.com/webfont/FastJS/44c5e752bfb44f5496bdfd310275ac39.js"></script>-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChinaCrowds</title>

    <!-- Bootstrap core CSS -->
    <link href="/Public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/Public/assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/Public/assets/css/carousel.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="/Public/assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="/Public/assets/jquery/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="/Public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/assets/js/common.js"></script>
    <script type="text/javascript" src="/Public/assets/js/validateonline.js"></script>
    

<!-- Some additional css -->
<link href="/Public/assets/css/style.css" rel="stylesheet">
</head>  
<body role="document">
<link href="../../../../Public/assets/css/font.css" rel="stylesheet" type="text/css">

    <div>
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div style="background-color:white">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" >
	          <span class="sr-only"><?php echo (L("Navigation")); ?></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
              <a class="yuwei-font-60px" href="#"><?php echo (L("ChinaCrowds")); ?></a>
            </div>
            
            <input type="hidden" id="lang" value="<?php echo (L("lang")); ?>"/>
            <?php if($_SESSION['requester_username'] != ''): ?><input type="hidden" id="requester_id" value="<?php echo ($_SESSION['requester_id']); ?>"/>
            <input type="hidden" id="usertype" value="requester"/>
            <input type="hidden" id="requester_token" value="<?php echo ($_SESSION['requester_token']); ?>"/>
            <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right" style="color:red">
	          	<?php if($_SESSION['requester_userstatus'] == '1'): ?><li>
	          		<!--<form action="<?php echo (C("WEB_URL")); ?>/Task/Search" method="post" class="navbar-form navbar-right">-->
	          		<!--<form action="<?php echo (C("WEB_URL")); ?>/Requester/index/page/<?php echo ($_SESSION['current_page']); ?>/ordering/<?php echo ($_SESSION['current_ordering']); ?>/tags=<?php echo ($_SESSION['current_tags']); ?>&search=<?php echo ($_SESSION['current_content']); ?>" method="post" class="navbar-form navbar-right">-->
					<form action="javascript:requester_search()" method="post" class="navbar-form navbar-right">
	          			<input type="text" class="form-control" name="search_content" id="search_content" placeholder="<?php echo (L("Search")); ?>...">
	        		</form>
	        	</li>
	        	<li><a href="<?php echo (C("WEB_URL")); ?>"><?php echo (L("Task List")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Requester/Dashboard"><?php echo (L("Dashboard")); ?></a></li><?php endif; ?>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Requester/Profile"><?php echo (L("Profile")); ?>(<?php echo ($_SESSION['requester_username']); ?>)</a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/switchuser"><?php echo (L("Switch User")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/dologout"><?php echo (L("Logout")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/api"><?php echo (L("API")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/help"><?php echo (L("Help")); ?></a></li>
	            <li>
					<?php if((L("lang")) == "en-us"): ?><!-- <a class="lang" href="?l=zh-cn" name="zh-cn">中文</a> -->
        				<a class="lang" onclick="change_zh_cn()" name="zh-cn" style="cursor:pointer;">中文</a><?php endif; ?>
        			<?php if((L("lang")) == "zh-cn"): ?><!-- <a class="lang" href="?l=en-us" name="en-us">English</a> -->
        				<a class="lang" onclick="change_en_us()" name="en-us" style="cursor:pointer;">English</a><?php endif; ?>
        		</li>
	          </ul>
	        </div><?php endif; ?>
	        			
			<?php if($_SESSION['worker_username'] != ''): ?><input type="hidden" id="worker_id" value="<?php echo ($_SESSION['worker_id']); ?>"/>
            <input type="hidden" id="usertype" value="worker"/>
            <input type="hidden" id="worker_token" value="<?php echo ($_SESSION['worker_token']); ?>"/>
            <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	          	<?php if($_SESSION['worker_userstatus'] == '1'): ?><li>
	          		<!--<form action="<?php echo (C("WEB_URL")); ?>/Task/Search" method="post" class="navbar-form navbar-right">-->
	          		<!--<form action="<?php echo (C("WEB_URL")); ?>/Worker/index?page=<?php echo ($_SESSION['current_page']); ?>&ordering=<?php echo ($_SESSION['current_ordering']); ?>&tags=<?php echo ($_SESSION['current_tags']); ?>&search=<?php echo ($_SESSION['current_content']); ?>" method="post" class="navbar-form navbar-right">-->
	          		<form action="javascript:worker_search()" method="post" class="navbar-form navbar-right">
	          			<input type="text" class="form-control" name="search_content" id="search_content" placeholder="<?php echo (L("Press Enter to")); echo (L("Search")); ?>...">
	        		</form>
	        	</li>
	        	<li><a href="<?php echo (C("WEB_URL")); ?>"><?php echo (L("Task List")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Worker/Dashboard"><?php echo (L("Dashboard")); ?></a></li><?php endif; ?>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Worker/Profile"><?php echo (L("Profile")); ?>(<?php echo ($_SESSION['worker_username']); ?>)</a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/switchuser"><?php echo (L("Switch User")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/dologout"><?php echo (L("Logout")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/api"><?php echo (L("API")); ?></a></li>
	            <li><a href="<?php echo (C("WEB_URL")); ?>/Index/help"><?php echo (L("Help")); ?></a></li>
				<li>
					<?php if((L("lang")) == "en-us"): ?><!-- <a class="lang" href="?l=zh-cn" name="zh-cn">中文</a> -->
        				<a class="lang" onclick="change_zh_cn()" name="zh-cn" style="cursor:pointer;">中文</a><?php endif; ?>
        			<?php if((L("lang")) == "zh-cn"): ?><!-- <a class="lang" href="?l=en-us" name="en-us">English</a> -->
        				<a class="lang" onclick="change_en_us()" name="en-us" style="cursor:pointer;">English</a><?php endif; ?>
        		</li>	          
        		</ul>
	        </div><?php endif; ?>
	        
	        <?php if($_SESSION['requester_username'] == '' && $_SESSION['worker_username'] == ''): ?><div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav ">
                <li><a href="<?php echo (C("WEB_URL")); ?>"><?php echo (L("Home")); ?></a></li>
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/aboutus"><?php echo (L("AboutUs")); ?></a></li>
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/contactus"><?php echo (L("ContactUs")); ?></a></li>
                <!--<li><a href="<?php echo (C("WEB_URL")); ?>/Index/api"><?php echo (L("API")); ?></a></li>-->
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/help"><?php echo (L("Help")); ?></a></li>
              </ul>
              <ul class="nav navbar-nav pull-right">
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/signin"><?php echo (L("SIGNIN")); ?></a></li>
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/signup"><?php echo (L("SIGNUP")); ?></a></li>
                <li>
					<?php if((L("lang")) == "en-us"): ?><!-- <a class="lang" href="?l=zh-cn" name="zh-cn">中文</a> -->
        				<a class="lang" onclick="change_zh_cn()" name="zh-cn" style="cursor:pointer;">中文</a><?php endif; ?>
        			<?php if((L("lang")) == "zh-cn"): ?><!-- <a class="lang" href="?l=en-us" name="en-us">English</a> -->
        				<a class="lang" onclick="change_en_us()" name="en-us" style="cursor:pointer;">English</a><?php endif; ?>
        		</li>
              </ul>
            </div><?php endif; ?>
            
          </div>
        </nav>

      </div>
    </div>
<script type="text/javascript" src="/Public/assets/js/strings.js"></script>
<script type="text/javascript">
function requester_search() {
	var search;
	if($('#search_content').val() == '') {
		search = "<?php echo ($current_search); ?>";
	}
	else {
		search = $('#search_content').val();
	}
	location.href = "<?php echo (C("WEB_URL")); ?>/Requester/index?search="+search;
}
function worker_search() {
	var search;
	if($('#search_content').val() == '') {
		search = "<?php echo ($current_search); ?>";
	}
	else {
		search = $('#search_content').val();
	}
	location.href = "<?php echo (C("WEB_URL")); ?>/Worker/index?search="+search;
}
</script>
<div class="container marketing pagebody">
    	
<h1 style="text-align:center"><?php echo (L("API")); ?></h1>

<h1>基本概念</h1>

<ul>
<li>task是一个任务</li>
<li>unit是一个单元, 每次会给worker展示多个unit作为一个page</li>
<li>question是一个问题, 每个unit可能有多个问题</li>
<li>answer是一个回答</li>
</ul>


<pre>
├── task_1
│   ├── unit_1
│   │   ├── question_1
│   │   │   ├── answer_1
│   │   │   ├── answer_2
│   │   │   ├── answer_3
│   │   │   └── answer_4
│   │   └── question_2
│   ├── unit_2
│   │   ├── question_1
│   │   └── question_2
│   └── unit_3
│       ├── question_1
│       └── question_2
├── task_2
└── task_3
</pre>


<h1>api调用文档</h1>

<p>目前的api部署在</p>

<ul>
<li>http://www.crowdbao.com:6789 (product)</li>
</ul>


<p>token验证的方式:</p>

<pre><code>除了login/register/stat/resetpwd-request/check-vtoken/reset-password不需要发送token外, 其余所有的api都需要url里附加token=XXX(无论get/post/put...);
token可以在login的时候获取, login会返回id和token, 以后api可以通过这个token获取用户信息;
token的过期时间是7天
</code></pre>

<h3>1. 基本CRUD</h3>

<p><strong>read: GET请求</strong></p>

<pre><code>例如
$.ajax(api_url+"/task/", {
    "type": "GET",
    "data": {
        "id":1,
        "publishedv":'True',
        "finished":'False',
        "ended":'False',
        "requester":1,
        "ordering":'-id',
        "page_size":10,
        "page":1,
        "token":'U:17838894685435883767',
        "tags":'',
        "search":''
    }
})
返回:
{
    "result":[{
        "id":372,
        "title":"",
        "description":"",
        "timestamp":"2015-04-01 08:12:59",
        "template_type":1,
        "judgements_per_unit":3,
        "units_for_qualification_test":10,
        "golden_units_in_first_pages":5,
        "golden_units_per_page":1,
        "units_per_page":10,
        "price":0.1,
        "min_accuracy_hidden":0.7,
        "min_accuracy":0.7,
        "total_units":0,
        "finished_units":0,
        "submitted_units":0,
        "published":false,
        "finished":false,
        "ended":false,
        "status":"init",
        "requester":26,
        "tags":[1,2,4]
        }]
}
id 为非必须，取值范围为task id的值；
published 为非必须，取值范围为”True”,”False”；
finished为非必须，取值范围为”True”,”False”；
ended为非必须，取值范围为”True”,”False”；
requester为非必须，取值范围为requester id的值；
ordering为非必须，取值范围为(+-)” id”, ” title”, ” price”, ” published”等；
page_size为非必须，分页时每页的大小；
page为非必须，分页时的页数；
token为必须；
tags为非必须，为数组，数组元素取值范围为整数类型1-6；
search为非必须，为搜索内容。
</code></pre>

<p><strong>过滤:</strong></p>

<pre><code>目前在Task表上可以根据id/published/finished/requster过滤, 注意published/finished需要写True/False 
过滤示例: /task?requester=15&amp;finished=False 
</code></pre>

<p><strong>排序:</strong></p>

<pre><code>目前在所有表上都可以进行排序, 排序的参数是ordering 
排序示例: /task?ordering=-id,finished 
</code></pre>

<p><strong>分页:</strong></p>

<pre><code>目前所有表上都可以进行分页, 分页的参数是page_size 如果没有page_size参数, 那么不分页; 分页和不分页的结果会很不一样, 分页了的结果是在json的result字段里面 
分页示例: 
/task?ordering=-id&amp;page_size=2: 
{
    "count": 5,
    "next":"http://localhost:8000/task/?ordering=-id&amp;page=2&amp;page_size=2",
    "previous": null,
    "results": [{
            "id": 6,
            "timestamp": "2015-01-13T16:11:30Z",
            "description": "test",
            "judgements": 1,
            "units": 1,
            "published": false,
            "finished": false,
            "requester": 16
        },
        {
            "id": 5,
            "timestamp": "2015-01-13T15:37:25Z",
            "description": "test1",
            "judgements": 3,
            "units": 1,
            "published": false,
            "finished": false,
            "requester": 13
        }]
}
</code></pre>

<p><strong>获取Tag:</strong></p>

<pre><code>$.ajax({
        type:'get',
        url:api_url+'/tag/?token=',
        dataType: 'json',
});
返回
{
    [
    {"id":1,"description":"Technology"},
    {"id":2,"description":"Life"},
    {"id":3,"description":"Entertainment"},
    {"id":4,"description":"Sports"},
    {"id":5,"description":"Education"},
    {"id":6,"description":"Health"}
    ]
}
</code></pre>

<p><strong>update: PUT/PATCH 请求</strong></p>

<pre><code>例如
$.ajax(api_url+'/task/1/?token=',{    
            "type":"PATCH", 
            traditional: true, // 支持传输组
            "data":{
            "tag":[1,2,4],
            "title":"title",
            "description":"This is a new task"
    }
});
返回：
{
    "code": 0,
    "result": null
}

例如
$.ajax(api_url+'/task/1/?token=',{    
            "type":"PATCH", 
            "data":{    
        "units_for_qualification_test":"3",
        "min_accuracy":"0.7"
    }
});
返回：
{
    "code": 0,
    "result": null
}
</code></pre>

<p><strong>delete: DELETE请求到id对应的url</strong></p>

<pre><code>$.ajax("http://166.111.71.88:5678/task/1/?token=", {"type": "DELETE"})
无返回
</code></pre>

<h3>2. workflow相关</h3>

<p>这里的api包括核心的工作流程:</p>

<p>requester任务发布流程: create -> upload_option -> upload_normal_data -> upload_golden_data(optional) -> publish</p>

<p>worker做任务流程: unit(获取qualification test page或者normal page)->submit</p>

<p>task的status状态变化:</p>

<ul>
<li>调用create创建            更改为init</li>
<li>调用upload_option         更改为option</li>
<li>调用upload_normal_data    更改为dat</li>
<li>调用upload_golden_data    不变化</li>
</ul>


<p><strong>create: (创建一个新任务)</strong></p>

<pre><code>$.ajax(api_url+"/workflow/create?token=", {
    "type": "POST",
    "data": {
        "requester_id":1,
    }
})
返回：
{
    "code":0
    "result":{
        "id":1
    }
}
</code></pre>

<p><strong>upload_option: (上传option)</strong></p>

<pre><code>$.ajax(api_url+"/workflow/upload-option?token=", {
    "type": "POST",
    "data": {
        "task_id":1,
        "option":{
            "template":"please answer the following questions about {fruit}",
            "questions":[{
                "options":["red","orange","yellow"],
                "type-radio":1,
                "name":"question-id",
                "description":"choose the color"
            },
            {
                "type-checkbox":1,
                "options":["fruit","vegetable"],
                "name":"question-id",
                "description":"choose the category(multiple choices)"
            },
            {
                "type-input":1,
                "name":"question-id",
                "description":"input the chinese name"
            }]
        }
    }
})
返回：
{
    "code":0
    "result":{
        "golden-sample": "/media/task-373/golden-sample.txt",
        "normal-sample": "/media/task-373/normal-sample.txt"
    }
}
</code></pre>

<p><strong>get_option: (获取上传的option信息)</strong></p>

<pre><code>$.ajax(api_url+"/workflow/get-option?token=", {
    "type": "POST",
    "data": {
        "task_id":1,
    }
})
返回：
{
    "code":0
    "result":{
        "option":{
            "template":"please answer the following questions about {fruit}",
            "questions":[{
                "options":["red","orange","yellow"],
                "type-radio":1,
                "name":"question-id",
                "description":"choose the color"
            },
            {
                "type-checkbox":1,
                "options":["fruit","vegetable"],
                "name":"question-id",
                "description":"choose the category(multiple choices)"
            },
            {
                "type-input":1,
                "name":"question-id",
                "description":"input the chinese name"
            }]
        },
        golden-sample: "/media/task-373/golden-sample.txt",
        normal-sample: "/media/task-373/normal-sample.txt"
    }
}
</code></pre>

<p><strong>unit: (获取可以渲染template的json数据)</strong></p>

<pre><code>例如
$.ajax(api_url+"/workflow/unit?token=", {
    "type": "POST",
    "data": {
        "num_units":3
    }
})
返回：
{
    "code":0,
    "result":{
        "template":"please answer the following questions about {fruit}",
        "format":[{
            "description":"please answer the following questions about apple",
            "questions":[{
                "options":["red","orange","yellow"],
                "type-radio":1,
                "name":"question-id",
                "description":"choose the color"
                },
                {
                "type-checkbox":1,
                "options":["fruit","vegetable"],
                "name":"question-id",
                "description":"choose the category(multiple choices)"
                },
                {
                "type-input":1,
                "name":"question-id",
                "description":"input the chinese name"
                }]
            },
            {
            "description":"please answer the following questions about banana"
            },
            {
            "description":"please answer the following questions about orange"
            }]
    }
}

例如：
$.ajax(api_url+"/workflow/unit?token=", {
    "type": "POST",
    "data": {
        "task_id":1,
        "num_units":3
}
})
返回：
{   "code":0,
    "result":{
        "template":"please answer the following questions about {fruit}",
        "format":[{
            "description":"please answer the following questions about apple",
            "questions":[{
                "options":["red","orange","yellow"],
                "type-radio":1,
                "name":"question-id",
                "description":"choose the color"
                },
                {
                "type-checkbox":1,
                "options":["fruit","vegetable"],
                "name":"question-id",
                "description":"choose the category(multiple choices)"
                },
                {
                "type-input":1,
                "name":"question-id",
                "description":"input the chinese name"
                }]
            },
            {
            "description":"please answer the following questions about banana"
            },
            {
            "description":"please answer the following questions about orange"
            }]
        }
}
</code></pre>

<p><strong>upload_golden_data/upload_normal_data: (上传data)</strong></p>

<pre><code>$.ajax(api_url+"/workflow/upload-normal-data?token=", {
    "type": "POST",
    "data": {
        "task_id":1,
        "data":file
    }
})
返回：
{
    "code":0
}
</code></pre>

<p><strong>publish: (最终发布任务)</strong></p>

<pre><code>$.ajax({
        type: 'post',
        url: api_url+'/workflow/publish/?token=',
        data: {
            "task_id":1
        }
});
返回：
{
    "code":0
}
</code></pre>

<p><strong>download_answer: (下载答题结果)</strong></p>

<pre><code>$.ajax(api_url+"/workflow/download_answer?token=", {
    "type": "POST",
    "data": {
        "task_id":1,
    }
})
返回：
{
    csv文件内容(string)
}
</code></pre>

<p><strong>append_data: (追加data)</strong></p>

<pre><code>$.ajax(api_url+"/workflow/append-data?token=", {
    "type": "POST",
    "data": {
        "task_id":1,
        "data":file
    }
})
返回：
{
    "code":0
}
</code></pre>

<p><strong>end: (终止一个任务, 返钱给requester, 不能再次发布)</strong></p>

<pre><code>$.ajax({
        type: 'post',
        url: api_url+'/workflow/end/?token=',
        data: {"task_id":1},
    });
返回
{
    "code":0
}
</code></pre>

<h3>3. 算法自分配</h3>

<p>task分为普通模式的和开发者模式, 默认为普通模式, 如果将task的developer字段设置为True, 则变为开发者模式. 成为开发者模式之后就可以自分配算法.</p>

<pre><code>* 设置developer=True
* 设置developer_site="http://your_server_site.com"
* 搭建web server, 监听请求
    1. units
    2. submit
</code></pre>

<p><strong>分配单元</strong></p>

<pre><code>url: developer_site/units/
参数: {"data": u'{"task_id":421, "worker_id":10}'}
返回: json, 注意unit的数量不要超过之前设置的每页unit数量上限, 例如
{"unit_ids": [0, 2], "allowed": True}
</code></pre>

<p><strong>提交答案</strong></p>

<pre><code>url: developer_site/submit/
参数: {"data": {"worker_id": 10, "answers": [{"answer": "something...", "inner_unit_id": 0, "question_description": "something..."}, {"answer": "something...", "inner_unit_id": 2, "question_description": "something..."}], "task_id": 421}
返回: 空
</code></pre>

<h3>4. 其他</h3>

<p><strong>upload photo</strong></p>

<pre><code>参数: task_id
示例: /workflow/upload-zip?task_id=9
说明: POST请求，记得将content-type改为'multipart/form-data'. 请求的文件必须是一个.zip的文件，否则我们会返回错误代码.
结果示例:
{
  "result" : [
    "tasks/8/task-got/creey.dany.jorah.jpg",
    "tasks/8/task-got/kings_landing_croata.jpg",
    "tasks/8/task-got/winterfell_linodrieghe_by_lyno3ghe-d6ru8mz.jpg"
  ],
  "code" : 0
}
</code></pre>

<p><strong>get photo/thumbnail</strong></p>

<pre><code>[] means optional.

参数: photo_url, [width, ratio, quality]
示例: /media/?photo_url=tasks/9/task-got/winterfell_linodrieghe_by_lyno3ghe-d6ru8mz.jpg&amp;width=200
说明: GET请求, photo_url 就是上述API返回的地址. width指定图片的宽度，ratio指定图片的长宽比，目前只支持"original"和"square"，quality指定图片质量，1-100.

把这个地址拼接好填入 &lt;img src=""&gt; 即可.
</code></pre>

<!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#"><?php echo (L("Back to top")); ?></a></p>
        <p>&copy; <?php echo (L("copyright")); ?> &middot; <a href="<?php echo (C("WEB_URL")); ?>/Index/privacy"><?php echo (L("Privacy")); ?></a> &middot; <a href="<?php echo (C("WEB_URL")); ?>/Index/terms"><?php echo (L("Terms")); ?></a> &middot; 京ICP备15013016号</p>
      </footer>
</div><!-- /.container -->
<!-- Some additional javascript -->
<script type="text/javascript" src="/Public/assets/js/index.js"></script>

    <script type="text/javascript" src="/Public/assets/mustache/mustache.min.js"></script>
    <script type="text/javascript" src="/Public/assets/js/strings.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--script src="/Public/assets/js/ie10-viewport-bug-workaround.js"></script-->
  </body>
<!--<script  type="text/javascript">
/*<script  type="text/javascript">
/*$youziku.load(".myfont", "44c5e752bfb44f5496bdfd310275ac39", "ywyingbichangguiti");*/
/*[$youziku.load("#id2", "44c5e752bfb44f5496bdfd310275ac39", "ywyingbichangguiti");]*/
/*[$youziku.load(".myfont", "44c5e752bfb44f5496bdfd310275ac39", "ywyingbichangguiti");]*/
/*[$youziku.load(".class1", "44c5e752bfb44f5496bdfd310275ac39", "ywyingbichangguiti");]*/
/*[．．．]*/
/*$youziku.draw();
</script>*/
 -->
</html>