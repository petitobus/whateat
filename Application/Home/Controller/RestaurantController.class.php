<?php

/*
* 一些参数的命名规则
* sort
* 关于shop,restaurant
* -1 不显示
* 0  不显示在首页，可搜索。
* 1+ 排序
* 
* 关于shop_image
* -1 不显示
* 0 icon
* 1 显示在首页，或其他入口图像
* 2+ 本页面幻灯片
*
* 关于restaurant_image
* -1 不显示
* 0 icon
* 1 显示在首页，或其他入口图像
* 2~100 本页面幻灯片
* 100+ 用于展示的食物
*
* D('V_ModelOne_ModelTwo_ModelThree_Image')
* 上方法实体化了关于model_one,model_two,model_three和image的表。
* 且通过image表查询有关model_one的方法。
* 若model_one 和 model_two 均有id字段，则ViewModel中，字段更名为model_one_id和 model_two_id
* 若model_x 和 image 均有id字段，则ViewModel中，image.id字段更名为img_id
*/

namespace Home\Controller;
use Think\Controller;
class RestaurantController extends Controller {
	//SHOP首页
    public function index($country='法国',$category_id='1'){
		if(!IS_AJAX){
			//获取用户名username
			$username='新用户';
			$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();
			$Customer = M("Customer");
			$username = $Customer->where('open_id='.$open_id)->getField('username')[0];
			$this->assign("username",$username);
			
			//获取微店链接
			$SiteConst = M("SiteConst");
			$eshop = $SiteConst->getByName('eshop')[0];
			$this->assign("eshop",$eshop);
			
			//获取categories目录
			$VRestaurantCategory = D("V_RestaurantCategory_Image");
			$category_list = $VRestaurantCategory->field('id,name,img_path')->select();
			$this->assign("category_list",$category_list);
			
			//获取country目录
			$City = M("City");
			$country_list = $City->distinct(true)->field('country')->select();
			$this->assign("country_list",$country_list);
			
			//获取首页幻灯片图片
			$VRestaurantSlideImage = D("V_RestaurantSlide_Image");
			$condition['sort'] = array('egt',0);
			$slide_list = $VRestaurantSlideImage->field('img_path,redirect')
					->where($condition)->order('sort')
					->limit(10)->select();
			$this->assign("slide_list",$slide_list);
		
			//获取商店信息
			$restaurant_list=getRestaurantList($country,$category_id,0);
			$this->assign("restaurant_list",$restaurant_list);
		
			$this->show();
		}else{
			$restaurant_list=getRestaurantList($country,$category_id,10);
			$this->ajaxReturn($restaurant_list,'json');
		}
    }

	//A8页面全部餐厅
	public function all(){
		$condition['index'] = array('egt',0);
		$Restaurant = M('Restaurant');
		$restaurant_list = $Restaurant->field('id,name,tag,star')->where($condition)->order('name')->select();
			
		if(!IS_AJAX){
			$this->assign('restaurant_list',$restaurant_list);
			$this->display();
		}
		//针对A4页面后，再次搜索需要发送ajax请求，或许新的内容
		else{
			$this->ajaxReturn($restaurant_list,'json');
		}
    }
	
	//A7，附近的餐厅
	public function nearby($number=10){
		$VRestaurantImage = D("V_Restaurant_Image");
		$wechat = new \Common\Model\WechatModel();
		$position=$wechat->getPosition();
		$limit=returnSquareLimit($position['latitude'],$position['longtitude']);
		$condition['restaurant_sort'] = array('egt',0);
		$condition['img_sort'] = 0;//icon
		$condition['latitude'] = array('between',array($limit['latitude_min'],$limit['$latitude_max']));
		$condition['longtitude'] = array('between',array($limit['$longtitude_min'],$limit['longtitude_max']);
		$restaurant_base_list = $VRestaurantImage->field('restaurant_id,restaurant_name,restaurant_star,tel,adr,restaurant_icon,longtitude,latitude')
				->where($condition)->limit($number)->select();
		foreach ($restaurant_base_list as $key => $value) {
			$value['dist'] = getDistance();
			$value['map'] = getMap();
			$restaurant_list[] = $value; 
	    }
		
		//排序
		foreach($restaurant_list as $key => $value){
			$dist[$key]  = $value['dist'];
		}
		array_multisort($dist, $restaurant_list);	

		$this->assign('restaurant_list',$restaurant_list);
		$this->display();
	}
	
	//B2,餐厅信息
	public function restaurant($id,$number=10){
		
		//获取页面幻灯片
		$VRestaurantImage = D('V_Restaurant_Image');
		$condition['id']= $id;
		$condition['img_sort'] = array('between','2,100');//展示页幻灯
		$slide = $VRestaurantImage->where($condition)->order('img_sort')->limit($number)->getField('img_path');
		$condition['img_sort'] = 0;//icon
		$icon = $VRestaurantImage->where($condition)->order('img_sort')->limit($number)->getField('img_path')[0];
		$slide_size = count($slide);
		$this->assign('slide',$slide);
		$this->assign('slide_size',$slide_size);		
		
		//获取展示图片信息
		$condition['img_sort'] = array('gt',100);//食物展示图片
		$picture = $VRestaurantImage->where($condition)->order('img_sort')->limit($number)->getField('img_path');
		$this->assign('picture',$picture);		
		
		//获取餐厅信息
		$condition = array();
		$Restaurant = M('Restaurant');
		$restaurant = $Restaurant->field('name,id,adr,tel,time,content,latitude,longtitude')
				->where($condition)->select()[0];
		$restaurant['icon']=$icon;
		$wechat = new \Common\Model\WechatModel();
		$position=$wechat->getPosition();
		$restaurant['map']=getMap($position,$destination);
		$this->assign('restaurant',$restaurant);
		
		//获取menu信息
		$condition=array();
		$VMenuRestaurantImage=D('V_Menu_Restaurant_Image');
		$condition['restaurant_id']=$id;
		$condition['menu_sort']=array('egt',0);//可获得的商品
		$condition['img_sort']=1;//获取用于显示在入口页面的图片
		$menu_list = $VMenuRestaurantImage->field('img_path,menu_content,price,menu_id')->where($condition)->select();
		$this->assign('menu_list',$menu_list);
		
		$this->display();
	} 
	
	private function getRestaurantList($country,$category_id,$number=0){
		$restaurant_list =  array();
		//获取餐厅基本信息
		$VRestaurantCategoryCityImage = D("V_Restaurant_ShopCategory_City");
		$condition['restaurant_sort'] = array('gt',0);
		$condition['country']= $country;
		$condition['category_id']= $category_id;
		$condition['img_sort'] = 1;
		if($number!=0){
			$restaurant_base_list = $RShopCategoryCity->field('restaurant_id,restaurant_name,adr,img_path,longtitude,latitude')
				->where($condition)->order('restaurant_sort')->limit($number)
				->select();
		}else{
			$restaurant_base_list = $RShopCategoryCity->field('restaurant_id,restaurant_name,adr,img_path,longtitude,latitude')
				->where($condition)->order('restaurant_sort')
				->select();			
		}
		
		foreach ($restaurant_base_list as $key => $value) {
			$value['dist'] = getDistance();
			$value['map'] = getMap();
			$restaurant_list[] = $value; 
		}
		return $restaurant_list;
	}
	