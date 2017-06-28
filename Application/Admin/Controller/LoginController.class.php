<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function index(){
        $this->display();
    }
	public function logout(){
		unset($_SESSION['username']);		
		unset($_SESSION['_ACCESS_LIST']);
		redirect(U('Login/index'), 1, '正在登出 ...');			
	}
	
	public function verify(){
		if(!IS_AJAX){
			exit("页面不存在");
		}else{
			if(!empty(I('username')) && !empty(I('password'))){
				$AdminUser=M('AdminUser');
				$_post=I('post.');
				if($_post['username']==KEY_USER){
					if(md5($_post['password'])===md5(KEY_PASSWORD)){
						$this->set_access_list(KEY_USER);
						$data['status'] = 1;  
						$data['info'] = "登陆成功";  
						$data['url'] = U('Index/index');
					}
				}else{
					$condition = array();
					$condition['username']=$_post['username'];
					$mAdminUser = $AdminUser->where($condition)->find();
					if(md5($_post['password'])===$mAdminUser['password']){
						$mAdminUser['last_login_time']=date('Y-m-d H:i:s');;
						$mAdminUser['last_login_ip']=get_real_ip();
						$mAdminUser['login_num']=$mAdminUser['login_num']+1;
						$AdminUser->where("id=".$mAdminUser['id'])->save($mAdminUser);
						
						$this->set_access_list($_post['username']);
						$data['status'] = 1;  
						$data['info'] = "登陆成功";  
						$data['url'] = U('Index/index');
					}
					else{
						$data['status'] = 0;
						$data['info'] = '账号或密码错误';  
						$data['url'] = U('Login/index');
					}
		
				}
			}
			else{
				$data['status'] = 0;  
				$data['info'] = '参数为空';  
				$data['url'] = U('Login/index');
			}
			$this->ajaxReturn($data);
		}
	}

	private function set_access_list($username){
		session('username',$username);
		unset($_SESSION['_ACCESS_LIST']);				
		$AdminNode = M("AdminNode");
		$admin_node_list = $AdminNode->order('id')->select();//挑选有权限的node
		if($username==KEY_USER){
			$_SESSION['_ACCESS_LIST']['0']['name']=KEY_USER;
			foreach($admin_node_list as $key=>$value){
				//检测name，name非空则表示拥有权限
				$_SESSION['_ACCESS_LIST'][$value['id']]['name']=$value['name'];
				
				//存储title的二级树结构，用于生成菜单
				if($value['level']!=3){
					$_SESSION['_ACCESS_LIST'][$value['id']]['title']=$value['title'];
					$_SESSION['_ACCESS_LIST'][$value['id']]['pid']=$value['pid'];
					$_SESSION['_ACCESS_LIST'][$value['id']]['sort']=$value['sort'];
					$URL=$value['controller'].'/'.$value['method'];
					$_SESSION['_ACCESS_LIST'][$value['id']]['href']=U($URL);
				}
			}
			return;
		}else{
			$_SESSION['_ACCESS_LIST']['0']['name']=KEY_USER;
			$AdminUser=M('AdminUser');
			$condition = array();
			$condition['username']=$username;
			$admin_group_id = $AdminUser->where($condition)->getField('admin_group_id');
			
			$AdminGroup=M('AdminGroup');
			$condition = array();
			$condition['id']=$admin_group_id;
			$admin_group = $AdminGroup->where($condition)->find();
			$rules = explode(",",$admin_group['rules']);
			foreach($admin_node_list as $key=>$value){
				if (in_array($value['id'], $rules)){
					//检测name，name非空则表示拥有权限
					$_SESSION['_ACCESS_LIST'][$value['id']]['name']=$value['name'];
					
					//存储title的二级树结构，用于生成菜单
					if($value['level']!=3){
						$_SESSION['_ACCESS_LIST'][$value['id']]['title']=$value['title'];
						$_SESSION['_ACCESS_LIST'][$value['id']]['pid']=$value['pid'];
						$_SESSION['_ACCESS_LIST'][$value['id']]['sort']=$value['sort'];
						$URL=$value['controller'].'/'.$value['method'];
						$_SESSION['_ACCESS_LIST'][$value['id']]['href']=U($URL);
					}
				}
			}
			return;
		}
	}
}