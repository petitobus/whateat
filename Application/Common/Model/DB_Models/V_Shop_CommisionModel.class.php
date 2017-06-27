<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Shop_CommisionModel extends ViewModel{
    public $viewFields = array(
	'Shop' => array('id'=>'shop_id', 'name'=>'shop_name', 'adr', 'tel', 'time', 'tax_return', 'content', 'latitude', 'longtitude'),
	'Commission' => array('_on' => 'Commission.level_id' = 'Shop.level', 'commission'),
    );
}
