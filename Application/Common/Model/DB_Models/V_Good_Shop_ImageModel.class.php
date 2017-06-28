<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Good_Shop_ImageModel extends ViewModel{
    public $viewFields = array(
	'RGoodImage' => array('_on'='RGoodImage.good_id'='Good.id', '_on'=> 'RShopImage.img_id = Image.img_id'),
	'Shop' => array('name'=>'shop_name'),
	'Good' => array('_on'=>'Good.shop_id'='Shop.id', 'price', 'sort'=>'good_sort'),
	'Image' => array('img_path', 'sort'=>'img_sort'),
    );
}
