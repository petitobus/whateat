<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Shop_CommercialArea_Brand_CommisionModel extends ViewModel{
    public $viewFields = array(
	'RShopBrand' => array('_on' => 'RSshopBrand.shop_id = Shop.id', '_on'=>'RSshopBrand.brand_id = Brand.id'),
	'CommercialArea' => array('_on' => 'CommercialArea.id = Shop.area', 'city_name', 'country'),
	'Shop' => array('name'=>'shop_name'),
	'Brand' => array('brand_name'),
	'Commission' => array('_on' => 'Commission.level_id = Shop.level', 'commission'),
    );
}
