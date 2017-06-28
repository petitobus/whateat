<?php
namespace Merchant\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function index(){
        $this->display();
    }
	public function logout(){
		unset($_SESSION['MERCHANT_EMAIL']);		
		redirect(U('Login/index'), 1, 'Log out ...');			
	}
	
	public function verify(){
		if(!IS_AJAX){
			exit("页面不存在");
		}else{
			if(!empty(I('email')) && !empty(I('password'))){
				$_post=I('post.');
				$Shop=M('Shop');
				$condition = array();
				$condition['email']=$_post['email'];
				$mShop = $Shop->where($condition)->find();
				$Operator=M('Operator');
				$condition = array();
				$condition['operator_email']=$mShop['email'];
				$mOperator = $Operator->where($condition)->find();
				if(md5($_post['password'])===$mOperator['operator_password']){
					$_SESSION['MERCHANT_EMAIL']=$mShop['email'];
					$data['status'] = 1;  
					$data['info'] = "Login Success";  
					$data['url'] = U('Index/index');
				}
				else{
					$data['status'] = 0;
					$data['info'] = 'Email or password error';  
					$data['url'] = U('Login/index');
				}
	
			}
			else{
				$data['status'] = 0;  
				$data['info'] = 'Parameter error';  
				$data['url'] = U('Login/index');
			}
			$this->ajaxReturn($data);
		}
	}
}