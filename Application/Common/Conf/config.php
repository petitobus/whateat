<?php

define('DEBUG_MODE',true);

return array(
	//'配置项'=>'配置值'
	'URL_HTML_SUFFIX'=>'shtml',
	
	'TOKEN_ON' => true, //  是否开启令牌验证 默认关闭
	'TOKEN_NAME' => '__hash__', //  令牌验证的表单隐藏字段名称，默认为 __hash__
	'TOKEN_TYPE' => 'md5', // 令牌哈希验证规则 默认为 MD5
	'TOKEN_RESET' => true, 
	
	//数据库配置
	'db_type' => 'mysql',
	'db_host' => '47.93.53.119',
	'db_user' => 'admin_whateat',
	'db_pwd' => 'whateat123',
	'db_name' => 'admin_whateat',
	'db_port' => 3306,
	'db_prefix' => 'whateat_',
	'db_charset' => 'utf8'
);
