<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Brand_Shop_ImageModel extends ViewModel{
    public $viewFields = array(
	'RShopImage' => array('_on'=>'RShopImage.shop_id = Shop.id', '_on'=>'RShopImage.img_id = Image.img_id'),
	'RShopBrand' => array('_on'=>'RShopImage.shop_id = Shop.id', '_on'=>'RSshopBrand.brand_id = Brand.id'),
	'Shop' => array('name'=>'shop_name'),
	'Brand' => array('brand_name'),
	'Image' => array('img_path', 'sort'),
    );
}
