<?php
return array(
	/* 数据库配置 */
	/*'DB_TYPE'               => 'mysqli',         	// 数据库类型
	'DB_HOST'               => '127.0.0.1',     	// 服务器地址
    'DB_NAME'               => 'crowdsourcing',         		// 数据库名
    'DB_USER'               => 'root',          	// 用户名
	'DB_PWD'                => 'lifeark2014',  			// 密码
    'DB_PORT'               => '3306',          	// 端口
    'DB_PREFIX'             => 'crowdsourcing_',          	// 数据库表前缀
    'DB_SQL_LOG'            => false,            	// SQL执行日志记录*/

    'TMPL_CACHE_ON'         =>  true,

    /* SESSION设置 */
    'SESSION_AUTO_START'    => true,                // 是否自动开启Session
    'SESSION_PREFIX'        => 'crowdsourcing_',      // session 前缀

    /* 日志 */
    'LOG_EXCEPTION_RECORD'  => false,            	// 是否记录异常信息日志
    'LOG_RECORD'            => false,                // 默认不记录日志
    'LOG_TYPE'              => 'File',              // 日志记录类型 默认为文件方式
    'SHOW_ERROR_MSG'        => true,

	/* URL规则 */
	'URL_MODEL'             => 2,					// URL 访问规则
    'URL_CASE_INSENSITIVE'  => true,				// 默认false 表示URL区分大小写 true则表示不区分大小写
	'APP_SUB_DOMAIN_DEPLOY' => true,   			    // 是否开启子域名部署
    'MODULE_ALLOW_LIST'     => array('Home'),         // 允许访问的模块列表
    'MODULE_DENY_LIST'      => array('Common','Runtime'),           // 设置禁止访问的模块列表
    'DEFAULT_MODULE'        => 'Home',                              // 默认模块
    
	/* 多语言 */
	'LANG_SWITCH_ON' => true,   // 开启语言包功能
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'LANG_LIST'        => 'zh-cn,en-us,zh-tw', // 允许切换的语言列表 用逗号分隔
	'VAR_LANGUAGE'     => 'l', // 默认语言切换变量	

	/* 一些常量 */
	'API_URL'				=> 'http://166.111.71.172:6789',	// API地址
	//'API_URL'				=> 'http://123.57.10.206:6789',
	//'WEB_URL'				=> 'http://127.0.0.1:8080/web/index.php', // For VincentShenbw
	//'WEB_URL'				=> 'http://localhost/web/index.php', // For whn09
	'WEB_URL'				=> 'http://localhost/index.php', // For whn09
	//'WEB_URL'				=> 'http://www.chinacrowds.com', // For server
);
