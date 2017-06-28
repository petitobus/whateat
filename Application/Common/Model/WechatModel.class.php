<?php
namespace Common\Model;

/**
 * 定义常数
 *
 */

 define('APPID', 'wxad5fb0e3a1be9889');
 define('SECRET', '3166ed516ddc608624dd00a5d7fc9f7b');
 

//TODO 关于微信的封装函数。
class WechatModel{
	Protected $autoCheckFields = false;
	
	/**
	* 请求微信Token
	* @return string Token
	*
	*/
	public function getToken() {
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
	
	//获取用户openId
	public function getOpenId(){
		//读取缓存open_id
		//缓存为空，或者失效的情况下，申请并更新缓存
		//查看open_id是否存在，如果存在都ok，不存在，添加新用户。
		//返回id
		
		
		
		return $open_id;
	}
	
	//获取用户位置
	public function getPosition(){
		return $position;
	}
	
	//验证微信服务器地址
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
			exit;
        }
    }

	//返回微信消息
    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                //libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = '你才'.$keyword;
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
					//添加新用户
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
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
	
	public function echostr($str){
		echo $str;
	}
}  