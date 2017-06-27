<?php
namespace Home\Controller;
use Think\Controller;
//微信卡券更新管理模块
class CreditController extends Controller {
    //积分页面
	public function index(){
       	$wechat = new \Common\Model\WechatModel();
		$open_id=$wechat->getOpenId();
		$Customer = D("Customer");
		$user['credit'] = $Customer->where('open_id='.$open_id)->getField('accumulated_pts')[0];
		$this->assign("user",$user);
		$this->display();
    }
	
	//发起提现请求
	public function cash(){
		//记录操作到log
		//整理发送的数据
		//发送向客户支付请求
		//成功则改变积分值（前端成功，则改变前端显示值，后台成功，更改数据库）
	}
	
	//发放微店的优惠券
	public function ticket(){
		//记录操作到log
		//整理发送的数据
		//发送优惠券请求
		//成功则改变积分值，投放消费卡券，失败则失败。
    }
	
}