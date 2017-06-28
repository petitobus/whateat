<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class VoucherController extends Controller
{

	public function voucher(){
		authenticate();
		$Voucher = M("Voucher");
		$condition = array();
		$voucher_list = $Voucher->where($condition)->order('_id desc')->select();
		$VoucherTrade = M('VoucherTrade');
		foreach($voucher_list as $key => $voucher){
			$count= $VoucherTrade->where('voucher_id='.$voucher[_id])->count();
			$amount= $VoucherTrade->where('voucher_id='.$voucher[_id])->sum('trans_amount');
			$voucher_list[$key]['count']=$count;
			$voucher_list[$key]['amount']=$amount;
		}
		$this->assign('voucher_list',$voucher_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$Voucher = M("Voucher");
		$voucher = $Voucher->where('_id='.$id)->select()[0];
		$this->assign('voucher',$voucher);
		$this->show();
	}

	public function code(){
		authenticate();
		$id=I('id');
		$Voucher = M("Voucher");
		$voucher = $Voucher->where('_id='.$id)->select()[0];
		$this->assign('voucher',$voucher);
		$this->show();
	}
	
    public function post(){
		authenticate();
		$method = I('get.method');
		$Voucher = M("Voucher");
		if($method == 'create'){
			$mVoucher=I('post.');
			if($mVoucher['voucher_code'][0] != 'V'){
				echo "[ERROR] Code首字母，作为标识符必须为‘V’.";	
				exit();
			}
			if($Voucher->create($mVoucher)){
				$Voucher->add();
				$this->redirect('voucher',null, 2, 'Voucher添加成功，页面跳转中...');
			}else{
				echo $Voucher->getError();
			}
		}
		else if($method == 'update'){
			$mVoucher=I('post.');
			if($mVoucher['voucher_code'][0] != 'V'){
				echo "[ERROR] Code首字母，作为标识符必须为‘V’.";	
				exit();
			}
			if($num =$Voucher->where('_id='.I('get.id'))->save($mVoucher)){
				$this->redirect('voucher',null, 2, 'Voucher更新成功，页面跳转中...');
			}if($num==0){
				$this->redirect('voucher',null, 2, '没有什么可以更新，页面跳转中...');
			}
			else{
				echo $Voucher->getError();
			}
		}
		else if($method == 'delete'){
			if($Voucher->where('_id='.I('get.id'))->delete()){
				$this->redirect('voucher',null, 2, 'Voucher删除成功，页面跳转中...');
			}else{
				echo $Voucher->getError();
			}
		}else{
			$this->redirect('voucher',null, 2, '参数错误，页面跳转中...');
		}
	}
}

