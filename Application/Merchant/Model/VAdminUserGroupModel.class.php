<?php
namespace Admin\Model;

use Think\Model\ViewModel;

//操作员
class VAdminUserGroupModel extends ViewModel{
    public $viewFields = array(
	'AdminUser' => array('*'),
	'AdminGroup'=> array('title', '_on'=>'AdminUser.admin_group_id=AdminGroup.id'),
    );
}
