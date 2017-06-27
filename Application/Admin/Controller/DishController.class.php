<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class DishController extends Controller
{
	public function dish($keyword=''){
		authenticate();
		$Dish = D("Dish");
		$condition = array();
		if($keyword!=''){
			$condition['name'] = array('like','%'.$keyword.'%');
		}
		$dish_list = $Dish->where($condition)->order('id desc')->select();
		foreach($shop_list as $key=>$dish){
			$dish_list[$key]["name"]=str_replace("'","’",$dish["name"]);
		}
		$this->assign('dish_list',$dish_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$Ingredient = M("Ingredient");
		$ingredient_list = $Ingredient->order('id desc')->select();
		$this->assign('ingredient_list',$ingredient_list);
		$Flavour = M("Flavour");
		$flavour_list = $Flavour->order('id desc')->select();
		$this->assign('flavour_list',$flavour_list);	
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$Dish = M("Dish");
		$dish = $Dish->where('id='.$id)->select()[0];
		$this->assign('dish',$dish);
		$Ingredient = M("Ingredient");
		$ingredient_list = $Ingredient->order('id desc')->select();
		$this->assign('ingredient_list',$ingredient_list);
		$Flavour = M("Flavour");
		$flavour_list = $Flavour->order('id desc')->select();
		$this->assign('flavour_list',$flavour_list);
		$Step = M("Step");
		$condition['dish_id']=$id;
		$step_list = $Step->where($condition)->order('id desc')->select();
		$this->assign('step_list',$step_list);
		
		$this->show();
	}

	public function img_upload(){
		authenticate();
		$id = I('id');
		$this->show();
	}
	
	public function img_handler(){
		authenticate();
		echo "hello";
	}
	
    public function post(){
		authenticate();
		$method = I('get.method');
		$Dish = M("Dish");
		if($method == 'create'){
			$mShop=I('post.');
			if($Dish->create($mShop)){
				$shop_id=$Dish->add();
				
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
					$this->redirect('dish',null, 2, 'shop添加成功，页面跳转中...');
				}else{
					echo $Operator->getError();
					$this->redirect('dish',null, 2, 'shop添加成功，请手动添加默认操作员...');
				}
			}else{
				echo $Dish->getError();
			}
		}
		else if($method == 'update'){
			$mShop=I('post.');
			$shop_org=$Dish->where('id='.I('get.id'))->find();
			$Operator=M('Operator');
			$condition=array();
			$condition['shop_id']=I('get.id');
			$condition['operator_email']=$shop_org['email'];
			$mOperator=$Operator->where($condition)->find();
			$mOperator['operator_email']=$mShop['email'];
			if($Operator->where('_id='.$mOperator['_id'])->save($mOperator)>=0){
				if($num = $Dish->where('id='.I('get.id'))->save($mShop)){
					$this->redirect('dish',null, 2, 'Shop更新成功，页面跳转中...');
				}if($num == 0){
					$this->redirect('dish',null, 2, '没有任何更新，页面跳转中...');
				}
				else{
					echo $Dish->getError();
				}
			}else{
				echo $Operator->getError();
			}
		}
		else if($method == 'delete'){
			$Operator=M('Operator');
			$condition['shop_id']=I('get.id');
			$num_operator=$Operator->where($condition)->count();
			if($num_operator>0){
				$this->redirect('Operator/operator',null, 3, '该商店仍有操作员未删除，请删除后重试，页面跳转中...');
			}
			
			if($Dish->where('id='.I('get.id'))->delete()){
				$this->redirect('dish',null, 2, 'Shop删除成功，页面跳转中...');
			}else{
				echo $Dish->getError();
			}
		}else{
			$this->redirect('dish',null, 2, '参数错误，页面跳转中...');
		}
	}
}