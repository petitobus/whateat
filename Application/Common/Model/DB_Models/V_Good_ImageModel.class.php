<?php
namespace Common\Model;

use Common\Model\ViewModel;

// C1获取产品列表
class V_Good_ImageModel extends ViewModel{
    public $viewFields = array(
	'RGoodImage' => array('_on'=>'RGoodImage.good_id = Good.id', '_on'=>'RGoodImage.img_id = Image.img_id'),
	'Good' => array('name' = > 'good_name'),
	'Image' => array('img_path', 'sort'=>'img_sort'),
    );
}
