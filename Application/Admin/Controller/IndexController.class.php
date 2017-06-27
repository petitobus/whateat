<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function home(){
		echo "今天是：". date("Y年m月d日")."</br></br>";
		$username = $_SESSION['username'];
		If($username != "admin") exit(0);
	}
	
	public function change_password(){
		authenticate();
		$username = $_SESSION['username'];
		if(isset($_POST['action'])&&($_POST['action']=='submitted')){
			$_post = I('post.');
			$condition = array();
			$condition['username']=$username;
			$AdminUser=M('AdminUser');
			$mAdminUser = $AdminUser->where($condition)->find();
			if(md5($_post['password'])===$mAdminUser['password']){
				$mAdminUser['password']=md5($_post['new_password']);
				if($num = $AdminUser->save($mAdminUser)){
					$this->redirect('home',null, 2, 'AdminUser更新成功，页面跳转中...');
				}if($num == 0){
					$this->redirect('home',null, 2, '没有任何更新，页面跳转中...');
				}
				else{
					echo $Operator->getError();
				}
			}else{
				$this->redirect('home',null, 2, '旧密码错误，页面跳转中...');
			}
		}
		$this->assign('username',$username);
		$this->show();
	}
	
	public function top_menu(){
		$_access_list=$_SESSION['_ACCESS_LIST'];
		$menu = array();
		foreach($_access_list as $id=>$value){
			if($value['pid']==1){	
			//主菜单
				$value['id']=$id;
				$menu[]=$value;
			}
		}
		
		$sort = array(); 
		foreach ($menu as $item) { 
			$sort[] = $item['sort']; 
		}
		array_multisort($sort, SORT_ASC, $menu);
		
		$this->assign('username',$_SESSION['username']);
		$this->assign('menu',$menu);
		$this->show();
	}
	public function left_menu(){
		$pid=I('pid');
		$_access_list=$_SESSION['_ACCESS_LIST'];
		$menu = array();
		foreach($_access_list as $id=>$value){
			if($value['pid']==$pid){	
			//辅菜单
				$value['id']=$id;
				$menu[]=$value;
			}
		}
		
		$sort = array(); 
		foreach ($menu as $item) { 
			$sort[] = $item['sort']; 
		}
		array_multisort($sort, SORT_ASC, $menu);
		
		$this->assign('menu',$menu);
		$this->assign('username',$_SESSION['username']);
		$this->show();
	}
	
	public function about_us(){
		echo "<p>powered by <a href='http://www.aiforu.com' target = '_top'>AIFORU</a></p>";
	}
	
	public function index(){
		authenticate();
		$this->assign('username',$_SESSION['username']);
		$this->show();
	}
	
	private function getMenu(){
		$_access_list=$_SESSION['_ACCESS_LIST'];
		$menu = array();
		foreach($_access_list as $id=>$value){
			if($id!=0&&isset($value['title'])&&$value['title']!=''){
				if($value['pid']==0){	
				//主菜单
					$menu[$id]=$value;
				}else{
				//子菜单
					$menu[$value['pid']]['children'][$id]=$value;
				}
			}
		}
		return ($menu);
	}
}