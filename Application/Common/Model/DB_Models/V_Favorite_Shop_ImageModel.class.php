<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Favorite_Shop_ImageModel extends ViewModel{
    public $viewFields = array(
	'RFavorite_shop' => array('_on'=>'RFavorite_shop.customer_id = Customer.id', '_on'=>'RFavorite_shop.shop_id = Shop.id'),
	'RShopImage' => array('_on'=>'RShopImage.shop_id = Shop.id', '_on' => 'RShopImage.img_id = Image.img_id'),
	'Customer' => array('id'=>'customer_id'),
	'Shop' => array('id', 'name', 'time'),
	'Image' => array('img_id', 'img_path'),
    );
}
