<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Shop_ShopCategory_City_ImageModel extends ViewModel{
    public $viewFields = array(
	'RShopCategory' => array('_on'=>'RShopCategory.shop_id = Shop.id', '_on' => 'RShopCategory.category_id = ShopCategory_id')
	'RShopImage' => array('_on'=>'RShopImage.Shop_id = Shop.id', '_on' => 'RShopImage.img_id = Image.img_id')
	'Shop' => array('sort'=>'shop_sort'),
	'ShopCategory' => ('category_name'=>'shop_category_name'),
	'City' => array('_on' => 'City.id = Shop.city', 'city_name', 'country'),
	'Image' => array('img_path', 'sort'=>'img_sort'),
    );
}
