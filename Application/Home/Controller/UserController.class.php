<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    //Moi首页
	public function index(){
        	$username='新用户';
			$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();
			$VCustomerImage = D("V_Customer_Image");
			$user = $VCustomerImage->field('id,img_path')
				->where('open_id='.$open_id)->select()[0];
			$this->assign("user",$user);
			$this->display();
			//TODO 生成微信会员卡
    }
	
	//用户信息页面
	public function user(){
        	$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();
			$VCustomerImage = D("V_Customer_Image");
			$user = $VCustomerImage->field('id,img_path,username_cn,username_en,sex,country,email,tel,birthday,wechat')
				->where('open_id='.$open_id)->select()[0];
			if($user['username_en']==''){
				$user['username_en']='New User';
			}
			if($user['username_cn']==''){
				$user['username_cn']='新用户';
			}
			$this->assign("user",$user);
			$this->display();
    }
		
	//用户积分页面（在积分控制系统里也可以查询积分）
	public function credit(){
        	$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();
			$Customer = D("Customer");
			$user['credit'] = $Customer->where('open_id='.$open_id)->getField('accumulated_pts')[0];
			$this->assign("user",$user);
			$this->display();
    }
	
	//更新用户信息
	public function update(){
	    $Customer=M('Customer');
		$wechat = new \Common\Model\WechatModel();
		$open_id=$wechat->getOpenId();	
		$data = array();
		$user = array();
		
		$user=I('post.');
		$user['open_id']=$open_id;
		$user['id'] = $Customer->where('open_id='.$open_id)->getField('id')[0];
		
		if(empty(I('username_cn'))){
			$user['username_cn']='新用户';
		}
		if(empty(I('username_en'))){
			$user['username_en']='new_user';
		}
		
		if($Customer->create($user)){
			if(!IS_AJAX){
				if($Customer->save()){
					$this->success('更新成功 ', U('User/user'));
				}else{
					$this->error('新增失败');
				}
			}else{
				if($Customer->save()){
					$data['status'] = 1;  
					$data['info'] = '更新成功';  
					$data['url'] = U('User/user');   
				}else{
					$data['status'] = 0;  
					$data['info'] = '更新失败';  
					$data['url'] = U('User/user');  
				}
				//通过ajaxReturn()方法返回我们之前生成的数组  
				$this->ajaxReturn($data);  
			}
		}else{
			exit($Customer->getError());
		}
    }
	
	
	//添加用户信息
	public function add(){
	    $data = array();
		$user = array();
		
		$user=I('post.');
		
		if(empty(I('username_cn'))){
			$user['username_cn']='新用户';
		}
		if(empty(I('username_en'))){
			$user['username_en']='new_user';
		}
		$user['time']=time();
		if($Customer->create($user)){
			if(!IS_AJAX){
				if($Customer->add()){
					$this->success('更新成功 ', U('User/user'));
				}else{
					$this->error('新增失败');
				}
			}else{
				if($Customer->add()){
					$data['status'] = 1;  
					$data['info'] = '更新成功';  
					$data['url'] = U('User/user');   
				}else{
					$data['status'] = 0;  
					$data['info'] = '更新失败';  
					$data['url'] = U('User/user');  
				}
				//通过ajaxReturn()方法返回我们之前生成的数组  
				$this->ajaxReturn($data);  
			}
		}else{
			exit($Customer->getError());
		}
    }
}
