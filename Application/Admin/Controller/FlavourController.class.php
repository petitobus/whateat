<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class FlavourController extends Controller
{
	public function flavour($keyword=''){
		authenticate();
		$Flavour = D("Flavour");
		$condition = array();
		if($keyword!=''){
			$condition['name'] = array('like','%'.$keyword.'%');
		}
		$flavour_list = $Flavour->where($condition)->order('id desc')->select();
		foreach($shop_list as $key=>$flavour){
			$flavour_list[$key]["name"]=str_replace("'","’",$flavour["name"]);
		}
		$this->assign('flavour_list',$flavour_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$Flavour = M("Flavour");
		$flavour = $Flavour->where('id='.$id)->select()[0];
		$this->assign('flavour',$flavour);
		$this->show();
	}
	
    public function post(){
		authenticate();
		$method = I('get.method');
		$Flavour = M("Flavour");
		if($method == 'create'){
			$mFlavour=I('post.');
			C('TOKEN_ON',false);
			if($Flavour->create($mFlavour)){
				$Flavour->add();
				C('TOKEN_ON',true);
				$this->redirect('flavour',null, 2, '调料添加成功，页面跳转中...');
			}else{
				C('TOKEN_ON',true);
				echo $Flavour->getError();
			}
		}
		else if($method == 'update'){
			$mFlavour=I('post.');
			if($num = $Flavour->where('id='.I('get.id'))->save($mFlavour)){
				$this->redirect('flavour',null, 2, '调料更新成功，页面跳转中...');
			}if($num == 0){
				$this->redirect('flavour',null, 2, '没有任何更新，页面跳转中...');
			}
			else{
				echo $Flavour->getError();
			}
		}
		else if($method == 'delete'){
			if($Flavour->where('id='.I('get.id'))->delete()){
				$this->redirect('flavour',null, 2, '调料删除成功，页面跳转中...');
			}else{
				echo $Flavour->getError();
			}
		}else{
			$this->redirect('flavour',null, 2, '参数错误，页面跳转中...');
		}
	}
}