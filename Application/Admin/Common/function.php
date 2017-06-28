<?php
	function authenticate($sensitive=false){
		$AdminNode = M("AdminNode");
		$condition['controller']=CONTROLLER_NAME;
		if($sensitive){
			$condition['method']=ACTION_NAME;
		}
		$node = $AdminNode->where($condition)->order('sort')->find();//挑选有权限的node
		$id = $node['id'];
		if(!isset($_SESSION['username'])){
			redirect(U('Login/index'),1,'登陆超时，请重新登录 ...','...'); 
		}else{
			if(!isset($_SESSION['_ACCESS_LIST'][$id]['name'])){
				exit("没有权限");
			}
		}
	}
?>