<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Customer_ImageModel extends ViewModel{
    public $viewFields = array(
	'RCustomerImage' => array ('_on' => 'RCustomerImage.customer_id = Customer.id', '_on', 'RCustomerImage.img_id = Image.img.id'),
	'Customer' => array ('wechat_id' = 'open_id', 'username_en', 'username_cn', 'sex', 'country', 'email', 'tel', 'birthday'),
	'Image' => array ('img_id', 'img_path', 'sort'=>'img_sort'),

    );
}
