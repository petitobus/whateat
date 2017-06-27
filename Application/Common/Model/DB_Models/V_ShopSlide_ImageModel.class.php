<?php
namespace Common\Model;

use Common\Model\ViewModel;

// SHOP首页

class V_ShopSlide_ImageModel extends ViewModel{
    public $viewFields = array(
	'RShopImage' => array('_on'=>'RShopImage.shop_id = Shop_id', '_on'=>'RShopImage.img_id = Image.id'),
	'Shop' => array('id'=>'shop_id', 'name'=>'shop_name'),
	'Image' => array('img_id', 'img_path', 'sort'),
	// TODO redirect?
    );
}
