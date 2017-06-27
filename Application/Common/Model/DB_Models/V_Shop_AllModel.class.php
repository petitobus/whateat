<?php
namespace Common\Model;

use Common\Model\ViewModel;

// 关键字搜索店家
class V_Shop_AllModel extends ViewModel{
    public $viewFields = array(
	'RShopBrand' => array('_on'=>'RShopCategory.shop_id = Shop.id', '_on'=>'RSshopBrand.brand_id = Brand.id'),
	'RShopCategory' => array('_on'=>'RShopCategory.shop_id = Shop.id', '_on' => = 'RShopCategory.category_id = ShopCategory.id', ),
	'Shop' => array('name'=>'shop_name','tag'=>'shop_tag'),
	'City' => array('_on' => 'City.id = Shop.city', 'city_name', 'country'),
	'Brand' => array('brand_name'),
	'CommercialArea' => array('_on' => 'CommercialArea.id = Shop.area', 'country'),
	'ShopCategory' => ('category_name'=>'shop_category_name'),
	),
    );
}
