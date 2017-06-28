<?php
namespace Common\Model;

use Common\Model\ViewModel;

//获取首页幻灯片图片
class V_RestaurantSlide_ImageModel extends ViewModel{
    public $viewFields = array(
	'RRestaurantImage' => array('*'),
	'Restaurant' => array('_on'=>'Restaurant.id'='RRestaurantImage.restaurant_id', 'name'=>'restaurant_name'),
	'Image' => array('_on'=>'Image.img_id' = 'RRestaurantImage.img_id', 'img_path', 'sort'),
    );
}
