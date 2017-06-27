<?php
namespace Admin\Model;

use Think\Model\ViewModel;

//操作员
class VCommercialAreaCityModel extends ViewModel{
    public $viewFields = array(
	'CommercialArea' => array('*'),
	'City'=> array('name'=>'city_name','country', '_on'=>'City.id=CommercialArea.city'),
    );
}
