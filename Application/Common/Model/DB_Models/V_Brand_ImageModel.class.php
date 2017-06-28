<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Brand_ImageModel extends ViewModel{
    public $viewFields = array(
	'RBrandImage' => array('_on'=>'RBrandImage.brand_id = Brand.id', '_on'=>'RBrandImage.img_id = Image.img_id'),
	'Brand' => array('name'=>'brand_name'),
	'Image' => array('img_path', 'sort'),
    );
}
