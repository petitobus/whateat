<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Good_Shop_CommissionModel extends ViewModel{
	// To modify controler : from "commision" to "commission" 
	// To modify controler : from "present" to "description" 
    public $viewFields = array(
	'RShopBrand' => array('_on'=>'RShopBrand.shop_id = Shop.id', '_on'=>'RShopBrand.brand_id = Brand.id'),
	'Brand' => array('name'=>'brand_name', 'icon'),
	'Shop' => array('name'=>'shop_name'),
	'Good' => array('id'=>'good_id','name'=>'good_name', 'price', 'description','content'=>'good_content', 'Good.shop_id = Shop.id'),
	'Commission' => array('_on' => 'Commission.level_id = Shop.level', 'commission'),
    );
}
