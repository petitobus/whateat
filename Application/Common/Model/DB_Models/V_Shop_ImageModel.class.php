<?php
namespace Common\Model;

use Common\Model\ViewModel;

//B1,商家信息
class V_Shop_ImageModel extends ViewModel{
	//same as V_ShopSlide_Image   
    public $viewFields = array(
	'RShopImage' => array('_on'=>'RShopImage.shop_id = Shop.id', '_on'=> 'RShopImage.img_id = Image.img_id'),
	'Shop' => array('name'=>'shop_name'),
	'Image' => array('img_path', 'sort'),
    );

}
