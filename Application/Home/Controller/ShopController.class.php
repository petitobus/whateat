<?php
/*命名规范：
* 控制器方法，小写，以_分割
* 变量，小写，以_分割
* private(或modele封装)函数，首字母小写，驼峰命名
* Model实体化，首字母大写，驼峰命名。
*
*/


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
class ShopController extends Controller {
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
			$ShopCategory = D("V_ShopCategory_Image");
			$category_list = $ShopCategory->field('id,name,img_path')->select();
			$this->assign("category_list",$category_list);
			
			//获取country目录
			$City = M("City");
			$country_list = $City->distinct(true)->field('country')->select();
			$this->assign("country_list",$country_list);

			
			//获取首页幻灯片图片
			$VShopSlideImage = D("V_ShopSlide_Image");
			$condition['sort'] = array('egt',0);
			$slide_list = $VShopSlideImage->field('img_path,redirect')
					->where($condition)->order('sort')
					->limit(10)->select();
			$this->assign("slide_list",$slide_list);
		
			//获取商店信息
			$shop_list=getShopList($country,$category_id,0);
			$this->assign("shop_list",$shop_list);
		
			$this->show();
		}else{
			$shop_list=getShopList($country,$category_id,10);
			$this->ajaxReturn($shop_list,'json');
		}
    }
	
	//A1，按城市搜索
	public function city(){
		$City = M("City");
		$city_list = $City->distinct(true)->field('id,name')->select();
		$this->assign("city_list",$country_list);
		$search_type='city';
		$this->assign('search_type',$search_type);
		$this->display();
	}
	
	//A2页面，按商圈搜索
	public function area(){
		$Area = M("CommercialArea");
		$area_list = $Area->distinct(true)->field('id,name')->select();
		$this->assign("area_list",$area_list);

		$search_type='area';
		$this->assign('search_type',$search_type);
		$this->display();
	}
	
	//A3,A4页面，处理搜索结果
	public function search($search_type = ''，$keyword = ''){
		$wechat = new \Common\Model\WechatModel();
		$open_id=$wechat->getOpenId();
		$Customer = M("Customer");
		$level_id = $Customer->where('open_id='.$open_id)->getField('level_id')[0];
		$condition['shop_sort'] = array('egt',0);
		$condition['level_id'] = $level_id;
		if(!IS_AJAX){
			//直接返回全部商家
			if($search_type='all'){
				$VShop = D("V_Shop_Brand_Commision");
				$title= '全部商家';
			}
			//按照城市筛选结果
			else if($search_type='city'){
				$VShop = D("V_Shop_City_Brand_Commision");
				$condition['city_id'] = $keyword;
				$City = M("City");
				$title = ($City->where('id='.$keyword)->getField('city_name')[0])."店铺";			
			}
			//按照商圈筛选结果
			else if($search_type='area'){
				$VShop = D("V_Shop_CommercialArea_Brand_Commision");
				$condition['area_id'] = $keyword;			
				$City = M("Commercial_area");
				$title = ($City->getFieldById($keyword,'area_name')[0])."区";
			}
			//按照关键字筛选结果
			else{
				$VShop = D("V_Shop_All");
				$condition['shop_name|shop_tag|country|city_name|area_name|brand_name|shop_category_name'] = array('like','%'.$keyword.'%');
				$title='search';
			}
			
			$shop_list = $VShop->field('shop_id,shop_name,shop_tag,brand_name,commision')->where($condition)->order('brand_name')->select();
			$brand_list = array();
			foreach($shop_list as $key=>$value){
				$value['first_word']=getfirstchar($value['brand_name']);
				$brand_list[$value['brand_name']][] = $value;
			}
			ksort($brand_list);
			
			$this->assign('title',$title);
			$this->assign('brand_list',$brand_list);
			$this->display();
		}
		//针对A4页面后，再次搜索需要发送ajax请求，或许新的内容
		else{
			$VShop = D("V_Shop_All");
			$condition['shop_name|shop_tag|country|city_name|area_name|brand_name|shop_category_name'] = array('like','%'.$keyword.'%');
			$shop_list = $VShop->field('shop_id,shop_name,brand_name,commision')
						->where($condition)->order('brand_name')->select();
			$brand_list = array();
			foreach($shop_list as $key=>$value){
				$value['first_word']=getfirstchar($value['brand_name']);
				$brand_list[$value['brand_name']][] = $value;
			}
			ksort($brand_list);
			
			$this->ajaxReturn($brand_list,'json');
		}
    }
	//A6，附近的商家
	public function nearby($number=10){
		$VShopBrandImage = D("V_Shop_Brand_Image");
		$wechat = new \Common\Model\WechatModel();
		$position=$wechat->getPosition();
		$limit=returnSquareLimit($position['latitude'],$position['longtitude']);
		$condition['shop_sort'] = array('egt',0);
		$condition['img_sort'] = 0;//icon
		$condition['latitude'] = array('between',array($limit['latitude_min'],$limit['$latitude_max']));
		$condition['longtitude'] = array('between',array($limit['$longtitude_min'],$limit['longtitude_max']);
		$shop_base_list = $VShopBrandImage->field('shop_id,shop_name,brand_name,tel,adr,shop_icon,longtitude,latitude')
				->where($condition)->limit($number)->select();
		foreach ($shop_base_list as $key => $value) {
			$value['dist'] = getDistance();
			$value['map'] = getMap();
			$shop_list[] = $value; 
	    }
		
		//排序
		foreach($shop_list as $key => $value){
			$dist[$key]  = $value['dist'];
		}
		array_multisort($dist, $shop_list);	

		$this->assign('shop_list',$shop_list);
		$this->display();
	}
	
	//B1,商家信息
	public function shop($id,$number=10){
		
		//获取页面幻灯片
		$VShopImage = D('V_Shop_Image');
		$condition['id']= $id;
		$condition['img_sort'] = array('gt',1);//展示页幻灯
		$slide = $VShopImage->where($condition)->order('img_sort')->limit($number)->getField('img_path');
		$slide_size = count($slide);
		$condition = array();
		
		$this->assign('slide',$slide);
		$this->assign('slide_size',$slide_size);		
		
		//获取品牌信息
		$VBrandShopImage = D('V_Brand_Shop_Image');
		$condition['shop_id']= $id;
		$condition['img_sort']=0;
		$brand = $VShopBrandImage->field('brand_id,brand_name,brand_icon')
				->where($condition)->select();
		if(count($brand)>1){
			$this->assign('brand_id',0);
			$this->assign('brand_list',$brand);			
		}else{
			$this->assign('brand_id',$brand[0]['brand_id']);
			$this->assign('brand_name',$brand[0]['brand_name']);
			$this->assign('brand_icon',$brand[0]['brand_icon']);
		}
		
		
		//获取商店信息
		$condition=array();
		$wechat = new \Common\Model\WechatModel();
		$open_id=$wechat->getOpenId();
		$Customer = M("Customer");
		$customer_level = $Customer->where('open_id='.$open_id)->getField('level_id')[0];
		$condition['level_id'] = $customer_level;
		$condition['shop_id']= $id;

		$VShopCommision = D('V_Shop_Commision');
		$shop = $VShopCommision->field('name,shop_id,adr,tel,time,commision,tax_return,content,latitude,longtitude')
				->where($condition)->select()[0];
		$position=$wechat->getPosition();
		$shop['map']=getMap($position,$destination);
		$this->assign('shop',$shop);
		
		//获取商品信息
		$condition=array();
		$VGoodShopImage=D('V_Good_Shop_Image');
		$condition['shop_id']=$id;
		$condition['good_sort']=array('egt',0);//可获得的商品
		$condition['img_sort']=1;//获取用于显示在入口页面的图片
		$good_list = $VShopGoodImage->field('img_path,price,good_id')->where($condition)->select();
		$this->assign('good_list',$good_list);
		
		$this->display();
	} 
	
	//C1获取产品列表
	public function good($id,$number=10){
		//获取页面幻灯片
		$VGoodImage = D('V_Good_Image');
		$condition['id']= $id;
		$condition['img_sort'] = array('gt',1);//显示在展示页面
		$slide = $VGoodImage->where($condition)->order('img_sort')->limit($number)->getField('img_path');
		$slide_size = count($slide);
		
		$this->assign('slide',$slide);
		$this->assign('slide_size',$slide_size);	
		
		//获取品牌信息
		$condition = array();
		$VBrandGoodImage = D('V_Brand_Good_Image');
		$condition['good_id']= $id;
		$condition['img_sort']= 0;
		$brand = $VBrandGoodImage->field('brand_id,brand_name,brand_icon')
				->where($condition)->select()[0];
		$this->assign('brand_id',$brand['brand_id']);
		$this->assign('brand_name',$brand['brand_name']);
		$this->assign('brand_icon',$brand['brand_icon']);
		
		//获取商品信息
		$condition=array();
		$wechat = new \Common\Model\WechatModel();
		$open_id=$wechat->getOpenId();
		$Customer = M("Customer");
		$customer_level = $Customer->where('open_id='.$open_id)->getField('level_id')[0];
		$condition['level_id'] = $customer_level;
		$condition['good_id']= $id;

		$VGoodShopCommision = D('V_Good_Shop_Commision');
		$good = $VGoodShopCommision->field('good_name,good_id,price,commision,present,good_content')
			->where($condition)->select()[0];
		$good['commision']=$good['price']*$good['commision']/100;
		
		$this->assign('Good',$good);
		
		$this->display();
	}
	
	//C2获取品牌列表
	public function brand($id,$number=10){
		//获取页面幻灯片
		$VBrandImage = D('V_Brand_Image');
		$condition['id']= $id;
		$condition['img_sort'] = array('gt',1);//展示页面图片
		$slide = $VBrandImage->where($condition)->order('img_sort')->limit($number)->getField('img_path');
		$slide_size = count($slide);
		
		$this->assign('slide',$slide);
		$this->assign('slide_size',$slide_size);	
		
		//获取品牌信息
		$condition = array();
		$Brand = M('Brand');
		$condition['id']= $id;
		$brand = $Brand->field('id,name,origin,year,category,site,content')
				->where($condition)->select()[0];
		$this->assign('brand',$brand);
		
		//获取商店信息
		$condition=array();
		$RShopBrand = D('R_Shop_Brand');
		$condition['brand_id']=$id;
		$condition['shop_sort']=array('egt',0);
		$shop_base_list = $RShopBrand->field('shop_name,shop_id,adr,brand_name')->where($condition)->select();
		foreach ($shop_base_list as $key => $value) {
			$value['dist'] = getDistance();
			$value['map'] = getMap();
			$shop_list[] = $value; 
		}
		
		$this->assign('shop_list',$shop_list);
		
		$this->display();
	}
	
	private function getShopList($country,$category_id,$number=0){
		$shop_list =  array();
		//获取商店基本信息
		$VShopCategoryCityImage = D("V_Shop_ShopCategory_City_Image");
		$condition['shop_sort'] = array('gt',0);
		$condition['country']= $country;
		$condition['category_id']= $category_id;
		$condition['img_sort']=1;
		if($number!=0){
			$shop_base_list = $RShopCategoryCity->field('shop_id,shop_name,adr,img_path,longtitude,latitude')
				->where($condition)->order('shop_sort')->limit($number)
				->select();
		}else{
			$shop_base_list = $RShopCategoryCity->field('shop_id,shop_name,adr,img_path,longtitude,latitude')
				->where($condition)->order('shop_sort')
				->select();			
		}
		
		foreach ($shop_base_list as $key => $value) {
			$value['dist'] = getDistance();
			$value['map'] = getMap();
			$shop_list[] = $value; 
		}
		return $shop_list;
	}
	
	private function getfirstchar($s0){      
        $c=preg_match('/[a-zA-Z]/', strtoupper(substr( $s0, 0, 1 )));
        if($c){
            return strtoupper(substr( $s0, 0, 1 )) ;
        }else{     
            $fchar = ord(substr($s0, 0, 1));
            if($fchar>=ord("a") and $fchar<=ord("Z") )return strtoupper($s0{0});
            if(is_numeric(substr( $s0, 0, 1 ))){
                $s0 =ToChinaseNum (substr( $s0, 0, 1 ));
            }
            $s= $s0;
            $asc=ord($s{0})*256+ord($s{1})-65536;
             
            if($asc>=-20319 and $asc<=-20284)return "A";
            if($asc>=-20283 and $asc<=-19776)return "B";
            if($asc>=-19775 and $asc<=-19219)return "C";
            if($asc>=-19218 and $asc<=-18711)return "D";
            if($asc>=-18710 and $asc<=-18527)return "E"; 
            if($asc>=-18526 and $asc<=-18240)return "F"; 
            if($asc>=-18239 and $asc<=-17923)return "G"; 
            if($asc>=-17922 and $asc<=-17418)return "H";              
            if($asc>=-17417 and $asc<=-16475)return "J";              
            if($asc>=-16474 and $asc<=-16213)return "K";              
            if($asc>=-16212 and $asc<=-15641)return "L";              
            if($asc>=-15640 and $asc<=-15166)return "M";              
            if($asc>=-15165 and $asc<=-14923)return "N";              
            if($asc>=-14922 and $asc<=-14915)return "O";              
            if($asc>=-14914 and $asc<=-14631)return "P";              
            if($asc>=-14630 and $asc<=-14150)return "Q";              
            if($asc>=-14149 and $asc<=-14091)return "R";              
            if($asc>=-14090 and $asc<=-13319)return "S";              
            if($asc>=-13318 and $asc<=-12839)return "T";              
            if($asc>=-12838 and $asc<=-12557)return "W";              
            if($asc>=-12556 and $asc<=-11848)return "X";              
            if($asc>=-11847 and $asc<=-11056)return "Y";              
            if($asc>=-11055 and $asc<=-10247)return "Z";  
            return null;
        }
	}
 
	private function ToChinaseNum($num){
		$char = array("零","一","二","三","四","五","六","七","八","九");
		$dw = array("","十","百","千","万","亿","兆");
		$retval = "";
		$proZero = false;
		for($i = 0;$i < strlen($num);$i++)
		{
			if($i > 0)    $temp = (int)(($num % pow (10,$i+1)) / pow (10,$i));
			else $temp = (int)($num % pow (10,1));
				
			if($proZero == true && $temp == 0) continue;
				
			if($temp == 0) $proZero = true;
			else $proZero = false;
				
			if($proZero)
			{
				if($retval == "") continue;
				$retval = $char[$temp].$retval;
			}
			else $retval = $char[$temp].$dw[$i].$retval;
		}
		if($retval == "一十") $retval = "十";
		return $retval;
	}
 
    private function returnSquareLimit($lng, $lat,$distance = 0.5){
        $earthRadius = 6378138;
        $dlng =  2 * asin(sin($distance / (2 * $earthRadius)) / cos(deg2rad($lat)));
        $dlng = rad2deg($dlng);
        $dlat = $distance/$earthRadius;
        $dlat = rad2deg($dlat);
        return array(
			'latitude_min'=>($lat-$dlat),
			'latitude_max'=>($lat+$dlat),
			'longtitude_max'=>($lng+$dlng),
			'longtitude_max'=>($lng+$dlng)
        );
   }
 
 //模拟测试函数
	private function getDistance($lat1, $lng1, $lat2, $lng2){      
		$earthRadius = 6378138; //近似地球半径米
		// 转换为弧度
		$lat1 = ($lat1 * pi()) / 180;
		$lng1 = ($lng1 * pi()) / 180;
		$lat2 = ($lat2 * pi()) / 180;
		$lng2 = ($lng2 * pi()) / 180;
		// 使用半正矢公式  用尺规来计算
		$calcLongitude = $lng2 - $lng1;
		$calcLatitude = $lat2 - $lat1;
		$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  
		$stepTwo = 2 * asin(min(1, sqrt($stepOne)));
		$calculatedDistance = $earthRadius * $stepTwo;
		return round($calculatedDistance);
	}
 
	function getMap($position,$destination){
		return 1;
	}

	function _mergerArray($array1, $array2, $field1, $field2 = '') { 
		$ret = array(); 
		//使用数组下标的办法 
		foreach ($array2 as $key => $value) { 
			$array3[$value[$field1]] = $value; 
		} 
		foreach ($array1 as $key => $value) { 
			$ret[] = array_merge($array3[$value[$field1]], $value); 
		} 
		return $ret; 
	} 
}
