<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class OperatorController extends Controller
{	
	//该操作员的voucher单子
	public function voucher_trade($trader_email=''){
		authenticate();
		$VoucherTrade = M("VoucherTrade");
		$condition = array();
		$condition['trader_email'] = $trader_email;
		$trade_list = $VoucherTrade->where($condition)->order('trans_create_time desc')->select();
		$this->assign('trade_list',$trade_list);
		//$this->display();
	}
	//该操作员的alipay单子
	public function alipay_trade($trader_email=''){
		authenticate();
		$VoucherTrade = M("AlipayTrade");
		$condition = array();
		$condition['trader_email'] = $trader_email;
		$trade_list = $VoucherTrade->where($condition)->order('trans_create_time desc')->select();
		$this->assign('trade_list',$trade_list);
		//$this->display();
	}
	
	public function operator($keyword=''){
		authenticate();		
		$VOperatorShop = D("VOperatorShop");
		$condition = array();
		if($keyword!=''){
			$condition['operator_email|operator_name|_id'] = array('like','%'.$keyword.'%');
		}
		$operator_list = $VOperatorShop->where($condition)->order('shop_id desc')->select();
		$this->assign('operator_list',$operator_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$Shop = M('Shop');
		$shop_list = $Shop->order('name desc')->select();
		$this->assign('shop_list',$shop_list);
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$Operator = M("Operator");
		$operator = $Operator->where('_id='.$id)->select()[0];
		$this->assign('operator',$operator);
		
		$Shop = M('Shop');
		$shop_list = $Shop->order('name desc')->select();
		$this->assign('shop_list',$shop_list);
		
		$this->show();
	}

    public function post(){
		authenticate();
		$method = I('get.method');
		$Operator = M("Operator");
		if($method == 'create'){
			$mOperator=I('post.');
			$mOperator['operator_password']=md5($mOperator['operator_password']);
			if($Operator->create($mOperator)){
				$Operator->add();
				$this->redirect('operator',null, 2, 'operator添加成功，页面跳转中...');
			}else{
				echo $Operator->getError();
			}
		}
		else if($method == 'update'){
			$mOperator=I('post.');
			if($mOperator['operator_password']== ''){
				unset($mOperator['operator_password']);
			}
			else{
				$mOperator['operator_password']=md5($mOperator['operator_password']);
			}
			if($num = $Operator->where('_id='.I('get.id'))->save($mOperator)){
				$this->redirect('operator',null, 2, 'Operator更新成功，页面跳转中...');
			}if($num == 0){
				$this->redirect('operator',null, 2, '没有任何更新，页面跳转中...');
			}
			else{
				echo $Operator->getError();
			}
		}
		else if($method == 'delete'){
			if($Operator->where('_id='.I('get.id'))->delete()){
				$this->redirect('operator',null, 2, 'Operator删除成功，页面跳转中...');
			}else{
				echo $Operator->getError();
			}
		}else{
			$this->redirect('operator',null, 2, '参数错误，页面跳转中...');
		}
	}
}