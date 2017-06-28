<?php
namespace Common\Model;

use Common\Model\ViewModel;

//附近灯餐厅
class V_Restaurant_ImageModel extends ViewModel{
    public $viewFields = array(
	'RRestaurantImage' => array('*'),
	'Restaurant' => array('_on'=>'Restaurant.id'='RRestaurantImage.restaurant_id', 'name'=>'restaurant_name'),
	'Image' => array('_on'=>'Image.img_id' = 'RRestaurantImage.img_id', 'img_path', 'sort'),
    );
}
