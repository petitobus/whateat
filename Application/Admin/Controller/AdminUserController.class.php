<?php
/**
 */

namespace Admin\Controller;
use Think\Controller;

class AdminUserController extends Controller
{
	public function admin_user($keyword=''){
		authenticate();
		$VAdminUserGroup = D("VAdminUserGroup");
		$admin_user_list = $VAdminUserGroup->order('id')->select();
		$this->assign('admin_user_list',$admin_user_list);
		$this->display();
	}
	
    public function create(){
		authenticate();
		$AdminGroup = M("AdminGroup");
		$admin_group_list = $AdminGroup->order('id')->select();
		$this->assign('admin_group_list',$admin_group_list);
		$this->show();
	}

    public function update(){
		authenticate();
		$id=I('id');
		$AdminUser = M("AdminUser");
		$admin_user = $AdminUser->where('id='.$id)->select()[0];
		$this->assign('admin_user',$admin_user);
		
		$AdminGroup = M("AdminGroup");
		$admin_group_list = $AdminGroup->order('id')->select();
		$this->assign('admin_group_list',$admin_group_list);
		
		$this->show();
	}

    public function post(){
		authenticate(true);
		$method = I('get.method');
		$AdminUser = M("AdminUser");
		if($method == 'create'){
			$mAdminUser=I('post.');
			if($mAdminUser['username']==KEY_USER){
				$this->redirect('admin_user',null, 2, '用户名不被许可，页面跳转中...');
			}
			$mAdminUser['password']=md5($mAdminUser['password']);
			if($AdminUser->create($mAdminUser)){
				$AdminUser->add();
				$this->redirect('admin_user',null, 2, 'admin_user添加成功，页面跳转中...');
			}else{
				echo $AdminUser->getError();
			}
		}
		else if($method == 'update'){
			$mAdminUser=I('post.');
			if($mAdminUser['username']==KEY_USER){
				$this->redirect('admin_user',null, 2, '用户名不被许可，页面跳转中...');
			}
			if($mAdminUser['password']== ''){
				unset($mAdminUser['password']);
			}
			else{
				$mAdminUser['password']=md5($mAdminUser['password']);
			}
			if($num = $AdminUser->where('id='.I('get.id'))->save($mAdminUser)){
				$this->redirect('admin_user',null, 2, 'AdminUser更新成功，页面跳转中...');
			}if($num == 0){
				$this->redirect('admin_user',null, 2, '没有任何更新，页面跳转中...');
			}
			else{
				echo $AdminUser->getError();
			}
		}
		else if($method == 'delete'){
			if($AdminUser->where('id='.I('get.id'))->delete()){
				$this->redirect('admin_user',null, 2, 'AdminUser删除成功，页面跳转中...');
			}else{
				echo $AdminUser->getError();
			}
		}else{
			$this->redirect('admin_user',null, 2, '参数错误，页面跳转中...');
		}
	}
}
