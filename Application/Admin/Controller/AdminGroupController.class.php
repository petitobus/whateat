<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class AdminGroupController extends Controller
{
	public function admin_group($keyword=''){
		authenticate();
		$AdminGroup = M("AdminGroup");
		$condition = array();
		$admin_group_list = $AdminGroup->where($condition)->order('id')->select();
		$this->assign('admin_group_list',$admin_group_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$AdminGroup = M("AdminGroup");
		$admin_group = $AdminGroup->where('id='.$id)->select()[0];
		$this->assign('admin_group',$admin_group);
		
		$this->show();
	}

    public function authority(){
		authenticate();
		$id=I('id');
		
		$AdminGroup = M("AdminGroup");
		$admin_group = $AdminGroup->where('id='.$id)->find();
		$rules = explode(",",$admin_group['rules']);
		$AdminNode = M("AdminNode");
		$admin_node_list = $AdminNode->order('level')->select();//挑选有权限的node
		$admin_node_list_checked = array();
		foreach($admin_node_list as $key=>$value){
			$value['checked']='';
			if (in_array($value['id'], $rules)){
				$value['checked'] = 'checked';
			}
			$admin_node_list_checked[]=$value;
		}
		$admin_node_array = array();
		foreach($admin_node_list_checked as $node){
			switch($node['level']){
				case 0:
					$root_id = $node['id'];
					break;
				case 1:
					$admin_node_array[$node['id']]=$node;
					break;  
				case 2:
					$admin_node_array[$node['pid']]['children'][$node['id']]=$node;
					break;
				case 3:
					$admin_node_array[0]['children'][$node['id']]=$node;
					break;
				default:
			}
		}
		$admin_node_array[0]['name']='sensitive_node';
		$admin_node_array[0]['title']='敏感节点';
		$this->assign('node_array',$admin_node_array);
		$this->assign('admin_group',$admin_group);
		$this->assign('root_id',$root_id);
		$this->show();
	}
	
	public function set_auth(){
		authenticate(true);
		$_post=I('post.');
		$id = I('get.id');
		$rules='';
		foreach($_post as $key=>$value){
			if($key!=$value){
				$_hash = $value;
			}
			else{
				$rules = $rules.','.$value;
			}
		}
		$rules=substr($rules, 1);
		$mAdminGroup['rules']=$rules;
		$mAdminGroup['__hash__']=$_hash;
		$AdminGroup=M('AdminGroup');
		if($num = $AdminGroup->where('id='.$id)->save($mAdminGroup)){
			$this->redirect('admin_group',null, 2, 'admin_group权限设置成功，重新登陆生效，页面跳转中...');
		}if($num == 0){
			$this->redirect('admin_group',null, 2, '没有任何更新，页面跳转中...');
		}
		else{
			echo $AdminGroup->getError();
		}
	}
	
    public function post(){
		authenticate();
		$method = I('get.method');
		$AdminGroup = M("AdminGroup");
		if($method == 'create'){
			$mAdminGroup=I('post.');
			$AdminNode=M('AdminNode');
			$root_node = $AdminNode->where('level=0')->order('level')->find();//挑选有权限的node
			$mAdminGroup['rules']=$root_node['id'];
			if($AdminGroup->create($mAdminGroup)){
				$AdminGroup->add();
				$this->redirect('admin_group',null, 2, 'admin_group添加成功，页面跳转中...');
			}else{
				echo $AdminGroup->getError();
			}
		}
		else if($method == 'update'){
			$mAdminGroup=I('post.');
			if($num = $AdminGroup->where('id='.I('get.id'))->save($mAdminGroup)){
				$this->redirect('admin_group',null, 2, 'AdminGroup更新成功，页面跳转中...');
			}if($num == 0){
				$this->redirect('admin_group',null, 2, '没有任何更新，页面跳转中...');
			}
			else{
				echo $AdminGroup->getError();
			}
		}
		else if($method == 'delete'){
			if($AdminGroup->where('id='.I('get.id'))->delete()){
				$this->redirect('admin_group',null, 2, 'AdminGroup删除成功，页面跳转中...');
			}else{
				echo $AdminGroup->getError();
			}
		}else{
			$this->redirect('admin_group',null, 2, '参数错误，页面跳转中...');
		}
	}
}
