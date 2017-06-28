<?php

function test(){
	echo "test";
}	

function to_format_time($org_time,$format="Y-m-d H:i:s"){	
	$format=str_replace("Y",substr($org_time,0,4),$format);
	$format=str_replace("m",substr($org_time,4,2),$format);
	$format=str_replace("d",substr($org_time,6,2),$format);
	$format=str_replace("H",substr($org_time,8,2),$format);
	$format=str_replace("i",substr($org_time,10,2),$format);
	$format=str_replace("s",substr($org_time,12,2),$format);
	return $format;
}	

/**
 * $data待签名数据
 * 签名用商户私钥，必须是没有经过pkcs8转换的私钥
 * 最后的签名，需要用base64编码
 * return Sign签名
 */
function rsa_sign($data) {
    //读取私钥文件
    $priKey = file_get_contents('key/rsa_private_key.pem');
    //转换为openssl密钥，必须是没有经过pkcs8转换的私钥
    $res = openssl_get_privatekey($priKey);
    //调用openssl内置签名方法，生成签名$sign
    openssl_sign($data, $sign, $res);
    //释放资源
    openssl_free_key($res);
    //base64编码
    $sign = base64_encode($sign);
    return $sign;
}

function rsa_sign_str($data,$priKey) {

    //转换为openssl密钥，必须是没有经过pkcs8转换的私钥
    $res = openssl_get_privatekey($priKey);
    //调用openssl内置签名方法，生成签名$sign
    openssl_sign($data, $sign, $res);
    //释放资源
    openssl_free_key($res);
    //base64编码
    $sign = base64_encode($sign);
    return $sign;
}

/**
 * $data待签名数据
 * $sign需要验签的签名
 * 验签用支付宝公钥
 * return 验签是否通过 bool值
 */
function rsa_verify($data, $sign)  { 
    //读取支付宝公钥文件
    $pubKey = file_get_contents('key/alipay_public_key.pem');
    //转换为openssl格式密钥
    $res = openssl_get_publickey($pubKey);
    //调用openssl内置方法验签，返回bool值
    $result = (bool)openssl_verify($data, base64_decode($sign), $res);
    //释放资源
    openssl_free_key($res);
    //返回资源是否成功
    return $result;
}

function rsa_verify_str($data,$sign,$pubKey) { 
    //转换为openssl格式密钥
    $res = openssl_get_publickey($pubKey);
    //调用openssl内置方法验签，返回bool值
    $result = (bool)openssl_verify($data, base64_decode($sign), $res);
    //释放资源
    openssl_free_key($res);
    //返回资源是否成功
    return $result;
}



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

function get_real_ip(){ 
	$ip=false; 
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){ 
		$ip=$_SERVER['HTTP_CLIENT_IP']; 
	}
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ 
		$ips=explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']); 
		if($ip){ array_unshift($ips, $ip); $ip=FALSE; }
		for ($i=0; $i < count($ips); $i++){
			if(!eregi ('^(10│172.16│192.168).', $ips[$i])){
				$ip=$ips[$i];
				break;
			}
		}
	}
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']); 
}
?>