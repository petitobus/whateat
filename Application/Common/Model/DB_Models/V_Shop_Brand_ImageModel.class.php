<?php
namespace Common\Model;

use Common\Model\ViewModel;

// A6，附近的商家
class V_Shop_Brand_ImageModel extends ViewModel{
    public $viewFields = array(
	'RShopBrand' => array('_on'=>'RShopBrand.shop_id =Shop.id', '_on'=>'RSshopBrand.brand_id = Brand.id'),
	'RShopImage' => array('_on'=>'RShopImage.shop_id = Shop.id', '_on'=>'RShopImage.img_id = Image.img_id'),
	'Shop' => array('id'=>'shop_id', 'name'=>'shop_name','tag'=>'shop_tag'),
	'Brand' => array('brand_name'),
	'Image' => array('img_path', 'sort'),
	),
    );
}
