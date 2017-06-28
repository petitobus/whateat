<?php
/**
 * 定义常数
 *
 */

 define('APPID', 'wxad5fb0e3a1be9889');
 define('SECRET', '3166ed516ddc608624dd00a5d7fc9f7b');
 
/**
 * 发送HTTP请求
 *
 * @param string $url 请求地址
 * @param string $method 请求方式 GET/POST
 * @param string $refererUrl 请求来源地址
 * @param array $data 发送数据
 * @param string $contentType 
 * @param string $timeout
 * @param string $proxy
 * @return boolean
 *
 */
function send_request($url, $data, $refererUrl = '', $method = 'GET', $contentType = 'application/json', $timeout = 300, $proxy = false) {
	$ch = null;
	if('POST' === strtoupper($method)) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER,0 );
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		if ($refererUrl) {
			curl_setopt($ch, CURLOPT_REFERER, $refererUrl);
		}
		if($contentType) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:'.$contentType));
		}
		if(is_string($data)){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		} else {
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		}
	} else if('GET' === strtoupper($method)) {

		if(is_string($data)) {
			$real_url = $url. (strpos($url, '?') === false ? '?' : ''). $data;
		} else {
			$real_url = $url. (strpos($url, '?') === false ? '?' : ''). http_build_query($data);
			
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $real_url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		if ($refererUrl) {
			curl_setopt($ch, CURLOPT_REFERER, $refererUrl);
		}
	} else {
		$args = func_get_args();
		return false;
	}

	if($proxy) {
		curl_setopt($ch, CURLOPT_PROXY, $proxy);
	}
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$ret = curl_exec($ch);
	$info = curl_getinfo($ch);
    $errno = curl_errno($ch);
	$contents = array(
			'httpInfo' => array(
					'send' => $data,
					'url' => $url,
					'ret' => $ret,
					'http' => $info,
			)
	);

	curl_close($ch);
	return $ret;
}

/**
 * 请求微信Token
 * @return string Token
 *
 */
function get_token() {
	//GLOBALS mysql;
	if($GLOBALS["access_token"]==null||((time()-$GLOBALS["token_timestamp"])>=$GLOBALS["expires_in"])){
		$post_data = array(
			'grant_type' => 'client_credential',
			'appid' => APPID,
			'secret' => SECRET		
		);
		$ret = json_decode(send_request('https://api.weixin.qq.com/cgi-bin/token', $post_data));
		$GLOBALS["access_token"] = $ret->{'access_token'};
		$GLOBALS["expires_in"] = $ret->{'expires_in'};
		$GLOBALS["token_timestamp"]=time();
	}
	return $GLOBALS["access_token"];

}

	echo get_token();
/**
 * 设置微信菜单栏
 * @return bool Token
 *
 */
function set_menu($post_menu) {
	$token = get_token();
	$real_url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token;
	//send_request($real_url,$post_menu,'','POST');
	 
}

?>