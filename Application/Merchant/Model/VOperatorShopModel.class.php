<?php
namespace Admin\Model;

use Think\Model\ViewModel;

//操作员
class VOperatorShopModel extends ViewModel{
    public $viewFields = array(
	'Operator' => array('*'),
	'Shop'=> array('name'=>'shop_name', '_on'=>'Operator.shop_id=Shop.id'),
    );
}
