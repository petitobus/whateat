<?php
namespace Admin\Model;

use Think\Model\ViewModel;

//操作员
class VShopCommercialAreaCityModel extends ViewModel{
    public $viewFields = array(
	'Shop' => array('*'),
	'CommercialArea'=> array('area_name'=>'commercial_area_name', '_on'=>'Shop.commercial_area_id = CommercialArea.id'),
    'City'=> array('name'=>'city_name', '_on'=>'Shop.city = City.id'),
    );
}
