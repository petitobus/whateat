<?php
namespace Home\Controller;
use Think\Controller;
class TradeController extends Controller {
    //获取订单列表页面，自带二维码
	public function index(){
		$wechat = new \Common\Model\WechatModel();
		$open_id=$wechat->getOpenId();
		if(!IS_AJAX){
			
		}else{
			
		}
    }
	
	//团购套餐，发起付款请求
	public function trade(){
		//生成订单
		//记录生成时间戳
		//整理发送的数据
		//由前端发送支付请求（接收到返回值后，状态改为已支付）
	}
	
	//成功付款后发放卡券（团购套餐）
	public function notify(){
		//检验安全码
		//更改订单状态
		//更改即将到帐积分
		//跳转到支付成功页面，投放消费卡券
    }
	
	//付款失败页面
	public function fail(){
		echo '付款失败';
    }
}