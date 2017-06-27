<?php
/**
 */

namespace Merchant\Controller;
use Think\Controller;

class AlipayTradeController extends Controller
{	

	//该操作员的alipay单子
	public function alipay_trade($page=1){
		authenticate();
		$Shop=M('Shop');
		$condition = array();
		$condition['email']=$_SESSION['MERCHANT_EMAIL'];
		$mShop = $Shop->where($condition)->find();
	
		$AlipayTrade = M("AlipayTrade");
		$lmt = ($page-1)*20;
		$condition['shop_id']= $mShop['id'];
		$trade_list = $AlipayTrade->where($condition)->order('trans_create_time desc')->limit($lmt.',20')->select();
		foreach($trade_list as $key=>$value){
			$trade_list[$key]['trans_create_time']=to_format_time($value['trans_create_time']);
		}
		$count= $AlipayTrade->where($condition)->count();
		$this->assign('trade_list',$trade_list);
		$this->assign('current_page',$page);
		if($page==ceil($count/20)){
			$next_page=$page;
		}else{
			$next_page=$page+1;
		}
		if($page==(1)){
			$last_page=$page;
		}else{
			$last_page=$page-1;
		}
		$this->assign('next_page',$next_page);
		$this->assign('last_page',$last_page);
		$this->assign('max_page',ceil($count/20));
		$this->show();
	}
	
    public function search(){
		authenticate();
		if(isset($_POST['action'])&&($_POST['action']=='submitted')){
			$condition=array();
			$condition=I('post.');
			unset($condition['action']);
			unset($condition['__hash__']);
			foreach($condition as $key=>$value){
				if($value==''){
					unset($condition[$key]);
				}else{
					if($key!='trans_create_time_begin'&&$key!='state'&&$key!='method'){
						$condition[$key]=array('like','%'.$value.'%');
					}
				}
			}
			if(isset($condition['trans_create_time_begin'])
				&&isset($condition['trans_create_time_end'])){
				$begin=$condition['trans_create_time_begin'];
				$begin=substr($begin, 0,4).substr($begin, 5,2).substr($begin, 8,2)."000000";
				$end=$condition['trans_create_time_end'];
				$end=substr($end, 0,4).substr($end, 5,2).substr($end, 8,2)."235959";
				$condition['trans_create_time']=array('between',$begin.','.$end);
				unset($condition['trans_create_time_begin']);
				unset($condition['trans_create_time_end']);
			}
			$AlipayTrade = M("AlipayTrade");
			
			$Shop=M('Shop');
			$condition['email']=$_SESSION['MERCHANT_EMAIL'];
			$mShop = $Shop->where($condition)->find();
			$condition['shop_id']=$mShop['id'];
			$trade_list = $AlipayTrade->where($condition)->order('trans_create_time desc')->select();
			foreach($trade_list as $key=>$value){
				$trade_list[$key]['trans_create_time']=to_format_time($value['trans_create_time']);
			}
			$this->assign('trade_list',$trade_list);
		}
		$this->show();
	}
}