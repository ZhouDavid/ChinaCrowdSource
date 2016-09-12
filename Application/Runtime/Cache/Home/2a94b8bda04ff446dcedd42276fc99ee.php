<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
    <link href="../../../../Public/assets/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">

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

</head>


<link href="../../../../Public/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="../../../../Public/assets/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<body role="document">  
	<link href="../../../../Public/assets/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<link href="../../../../Public/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
<div class="navbar-wrapper">
     <!-- <div class="container">-->

        <nav class="navbar navbar-default" style="height:60px;">
          <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	          <span class="sr-only"><?php echo (L("Navigation")); ?></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
              <a class="navbar-brand" style="color:#333;font-size:40px;" href="#"><?php echo (L("ChinaCrowds")); ?></a>
            </div>
            
            <input type="hidden" id="lang" value="<?php echo (L("lang")); ?>"/>
            <?php if($_SESSION['requester_username'] != ''): ?><input type="hidden" id="requester_id" value="<?php echo ($_SESSION['requester_id']); ?>"/>
            <input type="hidden" id="usertype" value="requester"/>
            <input type="hidden" id="requester_token" value="<?php echo ($_SESSION['requester_token']); ?>"/>
            <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
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
              <ul class="nav navbar-nav">
                <li><a href="<?php echo (C("WEB_URL")); ?>"><?php echo (L("Home")); ?></a></li>
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/aboutus"><?php echo (L("AboutUs")); ?></a></li>
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/contactus"><?php echo (L("ContactUs")); ?></a></li>
                <li><a href="<?php echo (C("WEB_URL")); ?>/Index/api"><?php echo (L("API")); ?></a></li>
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
       <!-- </nav>-->

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
	<!-- Carousel
    ================================================== -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<!--<li data-target="#myCarousel" data-slide-to="0"></li>-->
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<!--<div class="item">
				<img src="/Public/assets/img/crowdsourcing.png" alt="">
				<div class="container">
					<div class="carousel-caption">
						<h1><?php echo (L("title1")); ?></h1>
						<p><?php echo (L("content1")); ?></p>
						<p>
							<a class="btn btn-lg btn-primary"
								href="<?php echo (C("WEB_URL")); ?>/Index/signup" role="button"><?php echo (L("Sign Up")); ?></a>&nbsp;&nbsp;<a class="btn btn-lg btn-primary"
								href="<?php echo (C("WEB_URL")); ?>/Index/signin"><?php echo (L("Sign In")); ?></a>
						</p>
					</div>
				</div>
			</div>-->
			<div class="item active">
				<img src="/Public/assets/img/slider1.png" alt="">
				<div class="container">
					<div class="carousel-caption">
						<h1><?php echo (L("title2")); ?></h1>
						<p><?php echo (L("content2")); ?></p>
							<a class="btn btn-lg btn-primary"
								href="<?php echo (C("WEB_URL")); ?>/Index/signup" role="button"><?php echo (L("Sign Up")); ?></a>&nbsp;&nbsp;<a class="btn btn-lg btn-primary"
								href="<?php echo (C("WEB_URL")); ?>/Index/signin"><?php echo (L("Sign In")); ?></a>
						</p>
					</div>
				</div>
			</div>
			<div class="item">
				<img src="/Public/assets/img/slider2.png" alt="">
				<div class="container">
					<div class="carousel-caption">
						<h1><?php echo (L("title3")); ?></h1>
						<p><?php echo (L("content3")); ?></p>
							<a class="btn btn-lg btn-primary"
								href="<?php echo (C("WEB_URL")); ?>/Index/signup" role="button"><?php echo (L("Sign Up")); ?></a>&nbsp;&nbsp;<a class="btn btn-lg btn-primary"
								href="<?php echo (C("WEB_URL")); ?>/Index/signin"><?php echo (L("Sign In")); ?></a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button"
			data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"
			aria-hidden="true"></span> <span class="sr-only"><?php echo (L("Previous")); ?></span>
		</a> <a class="right carousel-control" href="#myCarousel" role="button"
			data-slide="next"> <span
			class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only"><?php echo (L("Next")); ?></span>
		</a>
	</div>
	<!-- /.carousel -->


	<!-- Marketing messaging and featurettes
    ================================================== -->
	<!-- Wrap the rest of the page in another container to center all the content. -->

	<div class="container marketing">

		<!-- Three columns of text below the carousel -->
		<div class="row">
			<div class="col-lg-4">
				<img class="img-circle" src="/Public/assets/img/1fast.png"
					alt="Generic placeholder image"
					style="width: 140px; height: 140px;">
				<h1><?php echo (L("subtitle1")); ?></h1>
				<p><?php echo (L("subcontent1")); ?></p>
				<!--<p>
					<a class="btn btn-default" href="#" role="button"><?php echo (L("View details")); ?>
						&raquo;</a>
				</p>-->
			</div>
			<!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<img class="img-circle" src="/Public/assets/img/2quality.png"
					alt="Generic placeholder image"
					style="width: 140px; height: 140px;">
				<h1><?php echo (L("subtitle2")); ?></h1>
				<p><?php echo (L("subcontent2")); ?></p>
				<!--<p>
					<a class="btn btn-default" href="#" role="button"><?php echo (L("View details")); ?>
						&raquo;</a>
				</p>-->
			</div>
			<!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<img class="img-circle" src="/Public/assets/img/3easy.png"
					alt="Generic placeholder image"
					style="width: 140px; height: 140px;">
				<h1><?php echo (L("subtitle3")); ?></h1>
				<p><?php echo (L("subcontent3")); ?></p>
				<!--<p>
					<a class="btn btn-default" href="#" role="button"><?php echo (L("View details")); ?>
						&raquo;</a>
				</p>-->
			</div>
			<!-- /.col-lg-4 -->
		</div>
		<!-- /.row -->
		<div class="row" style="text-align:center;">
			<div class="col-lg-6">
				<img class="img-circle" src="/Public/assets/img/android_download.png"
					alt="Generic placeholder image"
					style="width: 200px; height: 200px;">
				<h1><?php echo (L("android")); ?></h1>
				<!--<p><a href="http://www.wandoujia.com/apps/com.example.android.effectivenavigation" target="_blank"><?php echo (L("Click to download")); ?></a></p>-->
				<p><a href="/Public/assets/apk/crowdbao-1.0.apk" target="_blank"><?php echo (L("Click to download")); ?></a></p>
				<!--<p>
					<a class="btn btn-default" href="#" role="button"><?php echo (L("View details")); ?>
						&raquo;</a>
				</p>-->
			</div>
			<!-- /.col-lg-4 -->
			<div class="col-lg-6">
				<img class="img-circle" src="/Public/assets/img/ios_download.png"
					alt="Generic placeholder image"
					style="width: 200px; height: 200px;">
				<h1><?php echo (L("iOS")); ?></h1>
				<p><a href="https://itunes.apple.com/cn/app/zhong-bao/id979954172" target="_blank"><?php echo (L("Click to download")); ?></a></p>
				<!--<p>
					<a class="btn btn-default" href="#" role="button"><?php echo (L("View details")); ?>
						&raquo;</a>
				</p>-->
			</div>
			<!-- /.col-lg-4 -->
		</div>
		<!--<div class="row">
		<div class="col-lg-3"><h3><?php echo (L("Requesters")); ?>: <?php echo ($statInfo['num_requesters']); ?></h3></div>
		<div class="col-lg-3"><h3><?php echo (L("Workers")); ?>: <?php echo ($statInfo['num_workers']); ?></h3></div>
		<div class="col-lg-3"><h3><?php echo (L("Tasks")); ?>: <?php echo ($statInfo['num_all_tasks']); ?></h3></div>
		<div class="col-lg-3"><h3><?php echo (L("Available Tasks")); ?>: <?php echo ($statInfo['num_available_tasks']); ?></h3></div>
		</div>-->
 
  

<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
	</div>
	<!-- /.container -->
	<!-- Some additional javascript -->
 

   
     <!-- START THE FEATURETTES -->
<link href="../../../../Public/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">


      <hr class="featurette-divider">
      
<!-- /END THE FEATURETTES -->
<!--墙裙-->
<div type="hidden" class="row" style="background-color:#333;height:120px;font-size:14px;">
         <li class="col-lg-2">
          <p class="pull-right">
           <a class="" style="color:#fff;font-size:18px;"herf="#">机构组织</a><br><br>
           <a class="" style="color:#fff;"herf="#">关于我们</a><br>
           <a class="" style="color:#fff;"herf="#">团队成员</a><br>
           <a class="" style="color:#fff;"herf="#">其他研究成果</a><br>
          </p>
         </li>
          <li class="col-lg-2">
          <p class="pull-right">
           <a class="" style="color:#fff;font-size:18px;"herf="#">机构组织</a><br><br>
           <a class="" style="color:#fff;"herf="#">关于我们</a><br>
           <a class="" style="color:#fff;"herf="#">团队成员</a><br>
           <a class="" style="color:#fff;"herf="#">其他研究成果</a><br>
          </p>
         </li>
          <li class="col-lg-2">
          <p class="pull-right">
           <a class="" style="color:#fff;font-size:18px;"herf="#">机构组织</a><br><br>
           <a class="" style="color:#fff;"herf="#">关于我们</a><br>
           <a class="" style="color:#fff;"herf="#">团队成员</a><br>
           <a class="" style="color:#fff;"herf="#">其他研究成果</a><br>
          </p>
         </li>
       </div>
 <!--墙底-->

 <nav class="navbar navbar-default" style="border-color:#333;" >
  <div style="background-color:#333;">
  <div class="col-lg-1"></div>
   <div class="container-fluid">
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
       <a class="navbar-brand" style="font-size:30px;color:#fff;"href="#">众宝网</a></div>
     <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse col-lg-3" id="defaultNavbar1">
       <ul class="nav navbar-nav">
         <li><a style="color:#fff;"href="#">隐私条款</a></li>
         <li><a style="color:#fff;"href="#">隐私条款</a></li>
         <li><a style="color:#fff;"href="#">隐私条款</a></li>
       </ul>
     </div>
      <ul class="nav navbar-nav navbar-right ">
        <li><a style="color:#fff;"herf="#">京ICP备15013016号</a></li> 
        <li><a style="color:#fff;"herf="#">© 2015 清华大学，数据库实验室 版权所有</a></li> 
       </ul>
     <!-- /.navbar-collapse -->
   </div>
   <!-- /.container-fluid -->
   </div>
 </nav>

<!-- FOOTER -->
      <!--<footer>
        <p class="pull-right"><a href="#"><?php echo (L("Back to top")); ?></a></p>
        <p>&copy; <?php echo (L("copyright")); ?> &middot; <a href="<?php echo (C("WEB_URL")); ?>/Index/privacy"><?php echo (L("Privacy")); ?></a> &middot; <a href="<?php echo (C("WEB_URL")); ?>/Index/terms"><?php echo (L("Terms")); ?></a> &middot; 京ICP备15013016号</p>
      </footer>
      <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
      <script src="js/bootstrap.js" type="text/javascript"></script>-->
      
	 
    <script type="text/javascript" src="/Public/assets/mustache/mustache.min.js"></script>
    <script type="text/javascript" src="/Public/assets/js/strings.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--script src="/Public/assets/js/ie10-viewport-bug-workaround.js"></script-->

  </body>
      
</html>