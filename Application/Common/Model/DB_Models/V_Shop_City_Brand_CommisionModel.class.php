<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Shop_City_Brand_CommisionModel extends ViewModel{
    public $viewFields = array(
	'RShopBrand' => array('_on' => 'RSshopBrand.shop_id = Shop.id', '_on'=> 'RSshopBrand.brand_id = Brand.id'),
	'City' => array('_on' => 'City.id = Shop.city', 'city_name', 'country'),
	'Shop' => array('name'=>'shop_name'),
	'Brand' => array('brand_name'),
	'Commission' => array('_on' => 'Commission.level_id = Shop.level', 'commission'),
    );

}
