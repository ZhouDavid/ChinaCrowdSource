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
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	          <span class="sr-only"><?php echo (L("Navigation")); ?></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
              <a class="navbar-brand" href="#"><?php echo (L("ChinaCrowds")); ?></a>
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
        </nav>

      </div>
    </div>


    <div class="container marketing pagebody">
        <div class="row">
          <h2><span style="color: #444444;"><?php echo (L("Who are you signing in as?")); ?></span></h2>
          <div class="col-lg-6">
            <h2><span style="color: #254467;"><?php echo (L("Requester Sign In")); ?></span></h2>
            <div id="auth">
      
      <div class="well">
        <div class="heading">
          <h3><?php echo (L("Requester Sign In")); ?></h3>
          <div class="already-have-account"><?php echo (L("Don't have an account?")); ?>
            <a href="<?php echo (C("WEB_URL")); ?>/Index/signup" class="switch-login"><?php echo (L("Sign Up")); ?></a>
          </div>
        </div>
        <div class="authentication" id="requester-login-form">
          <div class="control-group string optional user_name">
            <label class="string optional control-label" for="user-name"><?php echo (L("User Name")); ?></label>
            <div class="controls">
              <input class="string optional" id="user_name_requester" name="user[name]" placeholder="<?php echo (L("User Name")); ?>" size="40" type="text" onkeydown="subRSigninCheck();">
            </div>
          </div>
          <div class="control-group password optional user_password">
            <label class="password optional control-label" for="user_password"><?php echo (L("Password")); ?></label>
            <div class="controls">
              <input class="password optional" id="user_password_requester" name="user[password]" pattern=".{8,128}" placeholder="<?php echo (L("Password")); ?>" size="40" type="password" onkeydown="subRSigninCheck();">
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" name="commit" id="requester_signin" value="Sign In"><?php echo (L("Sign In")); ?></button>
            <p><a href="<?php echo (C("WEB_URL")); ?>/Index/reset_requester"><?php echo (L("Forgot Password?")); ?></a></p>
          </div>
        </div>
      </div>
    </div>
          </div>
          <div class="col-lg-6">
            <h2><span style="color: #00ab4d;"><?php echo (L("Worker Sign In")); ?></span></h2>
            <div id="auth">
      
      <div class="well">
        <div class="heading">
          <h3><?php echo (L("Worker Sign In")); ?></h3>
          <div class="already-have-account"><?php echo (L("Don't have an account?")); ?>
            <a href="<?php echo (C("WEB_URL")); ?>/Index/signup" class="switch-login"><?php echo (L("Sign Up")); ?></a>
          </div>
        </div>
        <div class="authentication" id="worker-login-form">
          <div class="control-group string optional user_name">
            <label class="string optional control-label" for="user-name"><?php echo (L("User Name")); ?></label>
            <div class="controls">
              <input class="string optional" id="user_name_worker" name="user[name]" placeholder="<?php echo (L("User Name")); ?>" size="40" type="text" onkeydown="subWSigninCheck();">
            </div>
          </div>
          <div class="control-group password optional user_password">
            <label class="password optional control-label" for="user_password"><?php echo (L("Password")); ?></label>
            <div class="controls">
              <input class="password optional" id="user_password_worker" name="user[password]" pattern=".{8,128}" placeholder="<?php echo (L("Password")); ?>" size="40" type="password" onkeydown="subWSigninCheck();">
            </div>
          </div>
          <div class="form-actions">
            <button class="btn btn-primary" name="commit" id="worker_signin" value="Sign In"><?php echo (L("Sign In")); ?></button>
            <p><a href="<?php echo (C("WEB_URL")); ?>/Index/reset_worker"><?php echo (L("Forgot Password?")); ?></a></p>
          </div>
        </div>
      </div>
    </div>
          </div>
        </div>

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