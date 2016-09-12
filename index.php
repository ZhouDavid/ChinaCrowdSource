<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 做从根域名到主域名的301跳转
define('ROOT_DOMAIN', 'chinacrowds.com');
define('MAIN_DOMAIN', 'www.'.ROOT_DOMAIN);
define('COM_ROOT_DOMAIN', 'crowdbao.com');
define('COM_MAIN_DOMAIN', 'www.'.COM_ROOT_DOMAIN);
define('CN_ROOT_DOMAIN', 'crowdbao.cn');
define('CN_MAIN_DOMAIN', 'www'.CN_ROOT_DOMAIN);
define('SERVER_IP', '123.57.10.206');
$the_host = $_SERVER['HTTP_HOST'];//取得进入所输入的域名
$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';//判断地址后面部分
if($the_host == ROOT_DOMAIN || $the_host == SERVER_IP || $the_host == COM_ROOT_DOMAIN || $the_host == COM_MAIN_DOMAIN || $the_host == CN_ROOT_DOMAIN || $the_host == CN_MAIN_DOMAIN)//这是我要以前的域名地址
{
	header('HTTP/1.1 301 Moved Permanently');//发出301头部
	header('Location: http://'.MAIN_DOMAIN.$request_uri);//跳转到我的新域名地址
}

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

// 定义运行时目录
define('RUNTIME','./Runtime/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
