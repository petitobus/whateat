<?php
namespace Common\Model;

/* *********************************************************
 *                       视图模型
 * *********************************************************/
use Common\Model\ViewModel;

//获取menu信息
class V_Menu_Restaurant_ImageModel extends ViewModel{
    public $viewFields = array(
	'RMenuImage' => array('RMenuImage.menu_id = Menu.id', 'RMenuImage.img_id = Image.img_id'),
	'Restaurant' => array('name'=>'restaurant_name'),
	'Menu' => array('id'=>'menu_id', '_on'=>'Menu.restaurant_id = Restaurant_.id', 'name'=>'menu_name', 'content'=>'menu_content', 'price', 'sort'=>'menu_sort'),
	'Image' => array('img_id', 'img_path', 'sort'),
    );
}
