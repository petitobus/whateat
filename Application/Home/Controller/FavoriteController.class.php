<?php
namespace Home\Controller;
use Think\Controller;
class FavoriteController extends Controller {
    //收藏列表页面
	public function index(){
		$wechat = new \Common\Model\WechatModel();
		$open_id=$wechat->getOpenId();
		$VFavoriteImage = D("V_Favorite_Image");
		if(!IS_AJAX){
			$favorite_list = $VCustomerImage->field('id,type,item_id,name,img_path,time')
				->where('customer_id='.$open_id)->order('time')->select();
			$this->assign("favorite_list",$favorite_list);
			$this->display();
		}else{
			if(!empty(I('type'))){
				$condition['customer_id']=$open_id;
				$condition['type']=I('type');
				$favorite_list = $VCustomerImage->field('id,item_id,name,img_path,time')
					->where($condition)->order('time')->select();
				$data['status'] = 1;  
				$data['info'] = $favorite_list;  
				$data['url'] = U('Favorite/index');	
			}else{
				$data['status'] = 0;  
				$data['info'] = '参数为空';  
				$data['url'] = U('Favorite/index');
			}
			$this->ajaxReturn($data);
		}
    }
	
	//添加收藏
	public function add(){
	    if(!IS_AJAX){
			exit('页面不存在');
		}else{
			if(!empty(I('type')) && !empty(I('item_id'))){
				$favo = array();
				$wechat = new \Common\Model\WechatModel();
				$open_id=$wechat->getOpenId();
				$Favorite=M('Favorite');

				$favo=I('post.');//type,item_id
				$favo['customer_id']=$open_id;
				$favo['time']=time();
				$VItemImage = null;
				switch ($favo['type']){
					case 1:
						$VItemImage = D("V_Shop_Image");break;  
					case 2:
						$VItemImage = D("V_Good_Image");break;  
					case 3:
						$VItemImage = D("V_Brand_Image");break;   
					case 4:
						$VItemImage = D("V_Restaurant_Image");break;
					default:
						$data['status'] = 0;  
						$data['info'] = 'type错误';  
						$data['url'] = U('Favorite/index');  
						$this->ajaxReturn($data);
				}
				$condition['id']= $favo['item_id'];
				$condition['img_sort']=1;
				$item = $VItemImage->field('img_id,name')
					->where($condition)->select()[0];
				$favo['img_id']=$item['img_id'];
				$favo['name']=$item['name'];

				if($Favorite->create($favo)){
					if($Favorite->add()){
						$data['status'] = 1;  
						$data['info'] = '收藏成功';  
						$data['url'] = U('Favorite/index');
					}else{
						$data['status'] = 0;  
						$data['info'] = '收藏失败';  
						$data['url'] = U('Favorite/index');
					}
					//通过ajaxReturn()方法返回我们之前生成的数组  
					$this->ajaxReturn($data);
				}else{
					exit($Favorite->getError());
				}			
			}else{
				$data['status'] = 0;  
				$data['info'] = '参数为空';  
				$data['url'] = U('Favorite/index');
				$this->ajaxReturn($data);
			}				
		}
    }
	
	//删除收藏
	public function delete(){
		if(!IS_AJAX){
			exit('页面不存在');
		}else{
			$Customer=M('Customer');
			$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();	
			$data = array();
			
			$Favorite = M("Favorite");
			$condition['id']=I('id');
			$condition['customer_id']=$open_id;
			if($Favorite->where($condition)->delete()==1){
				$data['status'] = 1;  
				$data['info'] = '取消收藏';  
				$data['url'] = U('Favorite/index');
			}else{
				$data['status'] = 0;  
				$data['info'] = '取消收藏失败';  
				$data['url'] = U('Favorite/index');
			}
			$this->ajaxReturn($data);
		}
    }
}
