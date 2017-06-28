<?php
namespace Common\Model;

use Common\Model\ViewModel;

//获取餐厅基本信息
//TODO : to modify the V model name in controller
//       to modify variable name
class V_Restaurant_RestaurantCategory_CityModel extends ViewModel{
    public $viewFields = array(
	'RRestaurantCategory' => array('RRestaurantCategory.restaurant_id = RestaurantCategory.id','RRestaurantCategory.category_id = RestaurantCategory.id'),
	'RRestaurantImage' => array('RRestaurantImage.restaurant_id = Restaurant.id', 'RRestaurantImage.img_id = Image.img_id'),
	'Restaurant' => array('id'=>'restaurant_id', 'name'=>'restaurant_name', '_on'=>'Restaurant.city=City.id','adr', 'longtitude', 'latitude', 'sort'=>'restaurant_sort'),
	'RestaurantCategory' => array('id'=>'category_id', 'name'=>'category_name'),
	'City' => array('name'=>'city_name', 'conuntry'),
	'Image' => array('img_id', 'img_path', 'sort'=>'img_sort'),
    );
}
