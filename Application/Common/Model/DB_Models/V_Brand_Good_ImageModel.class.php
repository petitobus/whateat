<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Brand_Good_ImageModel extends ViewModel{
    public $viewFields = array(
	'RGoodImage' => array('_on'=>'RGoodImage.good_id = Good.id', '_on'=>'RGoodImage.img_id = Image.img_id'),
	'RShopBrand' => array('_on'=>'RShopBrand.shop_id = Shop.id', '_on'=>'RShopBrand.brand_id = Brand.id'),
	'Brand' => array('name', 'icon'),
	'Shop' => array('name' => 'shop_name'),
	'Good' => array('Good.shop_id = Shop.id'),
	'Image' => array('img_path', 'sort'=>'img_sort'),
    );
}
