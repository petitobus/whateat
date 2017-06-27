<?php
namespace Merchant\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function home(){
		authenticate();
		$this->show();
	}
	
	public function top_menu(){
		$Shop=M('Shop');
		$condition = array();
		$condition['email']=$_SESSION['MERCHANT_EMAIL'];
		$mShop = $Shop->where($condition)->find();
		$this->assign('shop',$mShop);
		$this->show();
	}
	public function left_menu(){
		$Shop=M('Shop');
		$condition = array();
		$condition['email']=$_SESSION['MERCHANT_EMAIL'];
		$mShop = $Shop->where($condition)->find();
		$this->assign('shop',$mShop);
		
		$item['href']=U('AlipayTrade/alipay_trade');
		$item['title']='Alipay Trade';
		$menu[]=$item;
		
		$item['href']=U('Index/contact_us');
		$item['title']='Contact Us';
		$menu[]=$item;
		$this->assign('menu',$menu);
		$this->show();
	}
	
	public function contact_us(){
		$this->show();
	}
	
	public function change_password(){
		authenticate();
		$Shop=M('Shop');
		$condition = array();
		$condition['email']=$_SESSION['MERCHANT_EMAIL'];
		$mShop = $Shop->where($condition)->find();
		if(isset($_POST['action'])&&($_POST['action']=='submitted')){
			$_post = I('post.');
			$condition = array();
			$condition['operator_email']=$mShop['email'];
			$condition['shop_id']=$mShop['id'];
			$Operator=M('Operator');
			$mOperator = $Operator->where($condition)->find();
			if(md5($_post['password'])===$mOperator['operator_password']){
				$mOperator['operator_password']=md5($_post['new_password']);
				if($num = $Operator->where('_id='.$mOperator['_id'])->save($mOperator)){
					$this->redirect('home',null, 2, 'update successfully...');
				}if($num == 0){
					$this->redirect('home',null, 2, 'nothing changed...');
				}
				else{
					echo $Operator->getError();
				}
			}else{
				$this->redirect('home',null, 2, 'password error...');
			}
		}
		$this->assign('username',$mShop['name']);
		$this->show();
	}

	public function index(){
		authenticate();
		$Shop=M('Shop');
		$condition = array();
		$condition['email']=$_SESSION['MERCHANT_EMAIL'];
		$mShop = $Shop->where($condition)->find();
		
		$this->assign('shop_name',$mShop['name']);
		$this->show();
	}
}