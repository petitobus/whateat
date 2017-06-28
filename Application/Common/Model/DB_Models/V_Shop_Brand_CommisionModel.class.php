<?php
namespace Common\Model;

use Common\Model\ViewModel;

// A3,A4页面
class V_Shop_Brand_CommisionModel extends ViewModel{
    public $viewFields = array(
	'RShopBrand' => array('_on' => 'RSshopBrand.shop_id = Shop_id','_on'=>'RSshopBrand.brand_id = Brand.id'),
	'Shop' => array('name'=>'shop_name'),
	'Brand' => array('brand_name'),
	'Commission' => array('_on' => 'Commission.level_id = Shop.level', 'commission'),
    );
}
