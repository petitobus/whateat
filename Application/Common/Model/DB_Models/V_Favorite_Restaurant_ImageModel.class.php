<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Favorite_Restaurant_ImageModel extends ViewModel{
    public $viewFields = array(
	'RFavorite_restaurant' => array('_on'=>'RFavorite_restaurant.customer_id = Customer.id', '_on'=>'RFavorite_restaurant.restaurant_id = Restaurant.id'),
	'RRestaurantImage' => array('_on'=>'restaurant_id = Restaurant.id', '_on' => 'img_id = Image.img_id'),
	'Customer' => array('id'=>'customer_id'),
	'Restaurant' => array('id', 'name', 'time'),
	'Image' => array('img_id', 'img_path'),
    );
}
