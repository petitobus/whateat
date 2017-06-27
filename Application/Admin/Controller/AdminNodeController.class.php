<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class AdminNodeController extends Controller
{
	
	public function admin_node($keyword=''){
		authenticate();
		$AdminNode = M("AdminNode");
		$admin_node_list = $AdminNode->order('level')->select();
		$this->assign('admin_node_list',$admin_node_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$AdminNode = M("AdminNode");
		$condition['level'] = array('elt','2');
		$admin_node_list = $AdminNode->where($condition)->order('id')->select();
		$this->assign('admin_pnode_list',$admin_node_list);
		$this->show();
	}

    public function update(){
		authenticate();
		$AdminNode = M("AdminNode");
		$condition['level'] = array('elt','2');
		$admin_node_list = $AdminNode->where($condition)->order('id')->select();
		$this->assign('admin_pnode_list',$admin_node_list);
		
		$id=I('id');
		$admin_node = $AdminNode->where('id='.$id)->select()[0];
		$this->assign('node',$admin_node);
		
		$this->show();
	}

    public function post(){
		authenticate(true);
		$method = I('get.method');
		$AdminNode = M("AdminNode");
		if($method == 'create'){
			$mAdminNode=I('post.');
			if($AdminNode->create($mAdminNode)){
				$AdminNode->add();
				$this->redirect('admin_node',null, 2, 'admin_node添加成功，页面跳转中...');
			}else{
				echo $AdminNode->getError();
			}
		}
		else if($method == 'update'){
			$mAdminNode=I('post.');
			if($num = $AdminNode->where('id='.I('get.id'))->save($mAdminNode)){
				$this->redirect('admin_node',null, 2, 'AdminNode更新成功，页面跳转中...');
			}if($num == 0){
				$this->redirect('admin_node',null, 2, '没有任何更新，页面跳转中...');
			}
			else{
				echo $AdminNode->getError();
			}
		}
		else if($method == 'delete'){
			if($AdminNode->where('id='.I('get.id'))->delete()){
				$this->redirect('admin_node',null, 2, 'AdminNode删除成功，页面跳转中...');
			}else{
				echo $AdminNode->getError();
			}
		}else{
			$this->redirect('admin_node',null, 2, '参数错误，页面跳转中...');
		}
	}
}
