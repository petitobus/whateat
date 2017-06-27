<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class ShopController extends Controller
{
	public function shop($keyword=''){
		authenticate();
		$ShopCommericalAreaCity = D("VShopCommercialAreaCity");
		$condition = array();
		if($keyword!=''){
			$condition['name|adr|tel|fax|email|level|description|content|tag|link|sort|open_time|tax_return|area|city|commercial_area_name|Merchant_ID|id'] = array('like','%'.$keyword.'%');
		}
		$shop_list = $ShopCommericalAreaCity->where($condition)->order('id desc')->select();
		$this->assign('shop_list',$shop_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$CommercialArea = M("CommercialArea");
		$commercial_area_list = $CommercialArea->order('id desc')->select();
		$this->assign('commercial_area_list',$commercial_area_list);
		$City = M("City");
		$city_list = $City->order('id desc')->select();
		$this->assign('city_list',$city_list);	
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$Shop = M("Shop");
		$shop = $Shop->where('id='.$id)->select()[0];
		$this->assign('shop',$shop);
		$CommercialArea = M("CommercialArea");
		$commercial_area_list = $CommercialArea->order('id desc')->select();
		$this->assign('commercial_area_list',$commercial_area_list);
		$City = M("City");
		$city_list = $City->order('id desc')->select();
		$this->assign('city_list',$city_list);	
		$this->show();
	}
	
	public function detail(){
		authenticate();
		$id=I('id');
		$Shop = M("Shop");
		$shop = $Shop->where('id='.$id)->select()[0];
		$this->assign('shop',$shop);
		$CommercialArea = M("CommercialArea");
		$commercial_area_list = $CommercialArea->order('id desc')->select();
		$this->assign('commercial_area_list',$commercial_area_list);
		$City = M("City");
		$city_list = $City->order('id desc')->select();
		$this->assign('city_list',$city_list);			
		$this->show();
	}

    public function post(){
		authenticate();
		$method = I('get.method');
		$Shop = M("Shop");
		if($method == 'create'){
			$mShop=I('post.');
			if($Shop->create($mShop)){
				$shop_id=$Shop->add();
				
				$mOperator['operator_email']=$mShop['email'];
				$mOperator['operator_name']=$mShop['name'];
				$mOperator['shop_id']=$shop_id;
				$mOperator['operator_password']=md5($mShop['operator_password']);
				$mOperator['operator_email']=$mShop['email'];
				$Operator=M('Operator');
				C('TOKEN_ON',false);
				if($Operator->create($mOperator)){
					$Operator->add();
					C('TOKEN_ON',true);
					$this->redirect('shop',null, 2, 'shop添加成功，页面跳转中...');
				}else{
					echo $Operator->getError();
					$this->redirect('shop',null, 2, 'shop添加成功，请手动添加默认操作员...');
				}
			}else{
				echo $Shop->getError();
			}
		}
		else if($method == 'update'){
			$mShop=I('post.');
			if($num = $Shop->where('id='.I('get.id'))->save($mShop)){
				$this->redirect('shop',null, 2, 'Shop更新成功，页面跳转中...');
			}if($num == 0){
				$this->redirect('shop',null, 2, '没有任何更新，页面跳转中...');
			}
			else{
				echo $Shop->getError();
			}
		}
		else if($method == 'delete'){
			if($Shop->where('id='.I('get.id'))->delete()){
				$this->redirect('shop',null, 2, 'Shop删除成功，页面跳转中...');
			}else{
				echo $Shop->getError();
			}
		}else{
			$this->redirect('shop',null, 2, '参数错误，页面跳转中...');
		}
	}
}