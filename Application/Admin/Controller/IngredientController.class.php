<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class IngredientController extends Controller
{
	public function ingredient($keyword=''){
		authenticate();
		$Ingredient = D("Ingredient");
		$condition = array();
		if($keyword!=''){
			$condition['name'] = array('like','%'.$keyword.'%');
		}
		$ingredient_list = $Ingredient->where($condition)->order('id desc')->select();
		foreach($shop_list as $key=>$ingredient){
			$ingredient_list[$key]["name"]=str_replace("'","’",$ingredient["name"]);
		}
		$this->assign('ingredient_list',$ingredient_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$Ingredient = M("Ingredient");
		$ingredient = $Ingredient->where('id='.$id)->select()[0];
		$this->assign('ingredient',$ingredient);
		$this->show();
	}
	
    public function post(){
		authenticate();
		$method = I('get.method');
		$Ingredient = M("Ingredient");
		if($method == 'create'){
			$mIngredient=I('post.');
			C('TOKEN_ON',false);
			if($Ingredient->create($mIngredient)){
				$Ingredient->add();
				C('TOKEN_ON',true);
				$this->redirect('ingredient',null, 2, '食材添加成功，页面跳转中...');
			}else{
				C('TOKEN_ON',true);
				echo $Ingredient->getError();
			}
		}
		else if($method == 'update'){
			$mIngredient=I('post.');
			if($num = $Ingredient->where('id='.I('get.id'))->save($mIngredient)){
				$this->redirect('ingredient',null, 2, '食材更新成功，页面跳转中...');
			}if($num == 0){
				$this->redirect('ingredient',null, 2, '没有任何更新，页面跳转中...');
			}
			else{
				echo $Ingredient->getError();
			}
		}
		else if($method == 'delete'){
			if($Ingredient->where('id='.I('get.id'))->delete()){
				$this->redirect('ingredient',null, 2, '食材删除成功，页面跳转中...');
			}else{
				echo $Ingredient->getError();
			}
		}else{
			$this->redirect('ingredient',null, 2, '参数错误，页面跳转中...');
		}
	}
}