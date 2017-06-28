<?php
/**
 */

namespace Install\Controller;
use Think\Controller;

class InstallController extends Controller
{
	
	public function install(){
		$servername='47.93.53.119';
		$username='admin_whateat';
		$password='whateat123';
		$namebd='admin_whateat';		
		
		$this->create_rbac_system($servername, $username,$password,$namebd);
		$this->create_ressouce_center($servername, $username,$password,$namebd);
	}
	
	private function create_ressouce_center($servername, $username,$password,$namebd){
		$westyleSQL = mysqli_connect($servername, $username,$password);
		if (!$westyleSQL){
			die('Could not connect: ' . mysqli_error($westyleSQL));
		}

		$bd_westyle=mysqli_select_db($westyleSQL,$namebd);
		C('TOKEN_ON',false);		
		$AdminNode=M("AdminNode");
		$mAdminNode["controller"]="";
		$mAdminNode["method"]="";
		$mAdminNode["name"]="ressouce_center";
		$mAdminNode["title"]="资源管理中心";
		$mAdminNode["sort"]="2";
		$mAdminNode["level"]="1";
		$mAdminNode["pid"]="1";
		$mAdminNode["remark"]="";
		$pid=-1;
		if($AdminNode->create($mAdminNode)){
			$pid=$AdminNode->add();
			echo "Insert root node SUCCESS</br>";
		}else{
			echo $AdminNode->getError();
		}
		$AdminNode=M("AdminNode");
		$mAdminNode["controller"]="Dish";
		$mAdminNode["method"]="dish";
		$mAdminNode["name"]="dish_root";
		$mAdminNode["title"]="菜单管理";
		$mAdminNode["sort"]="1";
		$mAdminNode["level"]="2";
		$mAdminNode["pid"]=$pid;
		$mAdminNode["remark"]="";
		if($AdminNode->create($mAdminNode)){
			$AdminNode->add();
			echo "Insert dish node SUCCESS</br>";
		}else{
			echo $AdminNode->getError();
		}
		$AdminNode=M("AdminNode");
		$mAdminNode["controller"]="Ingredient";
		$mAdminNode["method"]="ingredient";
		$mAdminNode["name"]="ingredient_root";
		$mAdminNode["title"]="食材管理";
		$mAdminNode["sort"]="2";
		$mAdminNode["level"]="2";
		$mAdminNode["pid"]=$pid;
		$mAdminNode["remark"]="";
		if($AdminNode->create($mAdminNode)){
			$AdminNode->add();
			echo "Insert ingredient node SUCCESS</br>";
		}else{
			echo $AdminNode->getError();
		}
		$AdminNode=M("AdminNode");
		$mAdminNode["controller"]="Flavour";
		$mAdminNode["method"]="flavour";
		$mAdminNode["name"]="flavour_root";
		$mAdminNode["title"]="调料管理";
		$mAdminNode["sort"]="3";
		$mAdminNode["level"]="2";
		$mAdminNode["pid"]=$pid;
		$mAdminNode["remark"]="";
		if($AdminNode->create($mAdminNode)){
			$AdminNode->add();
			echo "Insert flavour node SUCCESS</br>";
		}else{
			echo $AdminNode->getError();
		}
		C('TOKEN_ON',true);

		$sqls[] = 
			"CREATE TABLE IF NOT EXISTS whateat_dish ". 
			"(id int NOT NULL," .
			"PRIMARY KEY(id),".
			"name char(128),".
			"owner char(128),".
			"description tinytext)";
		$sqls[] = 
			"CREATE TABLE IF NOT EXISTS whateat_ingredient ". 
			"(id int NOT NULL," .
			"PRIMARY KEY(id),".
			"name char(128),".
			"description tinytext)";
		$sqls[] = 
			"CREATE TABLE IF NOT EXISTS whateat_flavour ". 
			"(id int NOT NULL," .
			"PRIMARY KEY(id),".
			"name char(128),".
			"description tinytext)";
		$sqls[] = 
			"CREATE TABLE IF NOT EXISTS whateat_step ". 
			"(id int NOT NULL," .
			"PRIMARY KEY(id),".
			"dish_id int NOT NULL,".
			"FOREIGN KEY (dish_id) REFERENCES whateat_dish(id),".
			"sort int,".
			"description text)";
		$sqls[] = 
			"CREATE TABLE IF NOT EXISTS whateat_dish_ingredient ". 
			"(id int NOT NULL," .
			"PRIMARY KEY (id),".
			"dish_id int NOT NULL ,".
			"ingredient_id int NOT NULL ,".
			"FOREIGN KEY (dish_id) REFERENCES whateat_dish(id),".
			"FOREIGN KEY (ingredient_id) REFERENCES whateat_ingredient(id),".
			"quantity char(32),".
			"level tinyint,".
			"description tinytext)";
		$sqls[] = 
			"CREATE TABLE IF NOT EXISTS whateat_dish_flavour ". 
			"(id int NOT NULL," .
			"PRIMARY KEY (id),".
			"dish_id int NOT NULL ,".
			"flavour_id int NOT NULL ,".
			"FOREIGN KEY (dish_id) REFERENCES whateat_dish(id),".
			"FOREIGN KEY (flavour_id) REFERENCES whateat_flavour(id),".
			"level tinyint,".
			"quantity char(32),".
			"description tinytext)";
		foreach($sqls as $sql){
			if (mysqli_query($westyleSQL,$sql) === TRUE) {
				echo "Table created successfully<br/> ";
			} else {
				echo "Error creating table: " .  mysqli_error($westyleSQL)."</br>";
			}
		}	
	}
	
	private function create_rbac_system($servername, $username,$password,$namebd){
		$westyleSQL = mysqli_connect($servername, $username,$password);
		if (!$westyleSQL){
			die('Could not connect: ' . mysqli_error($westyleSQL));
		}

		$bd_westyle=mysqli_select_db($westyleSQL,$namebd);
		if(!$bd_westyle){
			$sql='CREATE DATABASE '.$namebd;
			if (mysqli_query($westyleSQL,$sql)){
				$bd_westyle=mysqli_select_db($westyleSQL,$namebd);
			}
			else{
				echo "Error creating database: " . mysqli_error($westyleSQL);
			}
		}
		
		$sql = 
			"alter database ".$namebd." character set utf8;";

		if (mysqli_query($westyleSQL,$sql) === TRUE) {
		echo "Table utf8 set successfully<br/> ";
		} else {
		echo "Error set utf8</br>";
		}
		
		$sql = 
			"set names 'utf8'";

		if (mysqli_query($westyleSQL,$sql) === TRUE) {
		echo "Table utf8 set successfully<br/> ";
		} else {
		echo "Error creating table: " .  mysqli_error($westyleSQL)."</br>";
		}

		$sql = 
			"DROP TABLE `whateat_admin_group`, `whateat_admin_node`, `whateat_admin_user`";
		if (mysqli_query($westyleSQL,$sql) === TRUE) {
			echo "Admin table drop successfully<br/> ";
		} 
		
		$sql = 
			"CREATE TABLE IF NOT EXISTS whateat_admin_user ". 
			"(id int NOT NULL AUTO_INCREMENT unique," .
			"PRIMARY KEY(id),".
			"admin_group_id int NOT NULL,".
			"username char(60) NOT NULL unique,".
			"password char(60) NOT NULL,".
			"email char(60) NOT NULL,".
			"last_login_time char(60) NOT NULL,".
			"encrypt char(10) NOT NULL,".
			"status tinyint(2) NOT NULL,".
			"last_login_ip char(60) NOT NULL,".
			"login_num char(60) NOT NULL
			)";

		if (mysqli_query($westyleSQL,$sql) === TRUE) {
		echo "Table admin created successfully<br/> ";
		} else {
		echo "Error creating table: " .  mysqli_error($westyleSQL)."</br>";
		}
		
		$sql = 
			"CREATE TABLE IF NOT EXISTS whateat_admin_node ". 
			"(id int NOT NULL AUTO_INCREMENT unique," .
			"PRIMARY KEY(id),".
			"controller char(60) NOT NULL,".
			"method char(60) NOT NULL,".
			"name char(60) NOT NULL unique,".
			"title char(60) NOT NULL,".
			"sort tinyint(2) NOT NULL,".
			"level tinyint(2) NOT NULL,".
			"pid int(2) NOT NULL,".
			"remark tinytext NOT NULL
			)";

		if (mysqli_query($westyleSQL,$sql) === TRUE) {
		echo "Table admin node created successfully<br/> ";
		} else {
		echo "Error creating table: " .  mysqli_error($westyleSQL)."</br>";
		}
		
		$sql = 
			"CREATE TABLE IF NOT EXISTS whateat_admin_group ". 
			"(id int NOT NULL AUTO_INCREMENT unique," .
			"PRIMARY KEY(id),".
			"title char(60) NOT NULL ,".
			"description  char(60) NOT NULL ,".
			"rules tinytext)";
		
		if (mysqli_query($westyleSQL,$sql) === TRUE) {
			echo "Table admin grouop created successfully<br/> ";
		} else {
			echo "Error creating table: " .  mysqli_error($westyleSQL)."</br>";
		}
		
		$sql = 
			"
				INSERT INTO `whateat_admin_node` (`id`, `controller`, `method`, `name`, `title`, `sort`, `level`, `pid`, `remark`) VALUES
(1, 'Index', 'index', 'root', '根结点', 0, 0, -1, '请勿修改'),
(7, '', '', 'admin_center', '团队管理中心', 1, 1, 1, ''),
(8, 'AdminNode', 'admin_node', 'admin_node_root', '操作结点管理', 1, 2, 15, ''),
(9, 'AdminUser', 'admin_user', 'admin_user_root', '管理员管理', 2, 2, 7, ''),
(10, 'AdminGroup', 'admin_group', 'admin_group_root', '职能管理', 3, 2, 7, ''),
(11, 'AdminNode', 'post', 'admin_node_post', '操作结点数据库', 1, 3, 8, 'sensitive'),
(12, 'AdminGroup', 'set_auth', 'admin_node_set_auth', '组权限配置', 2, 3, 10, 'sensitive'),
(13, 'AdminUser', 'post', 'admin_user_post', '管理员职能变更', 1, 3, 9, 'sensitive'),
(15, '', '', 'system_center', '站长系统', 5, 1, 1, '非专业人士请勿更改');
			";
		if (mysqli_query($westyleSQL,$sql) === TRUE) {
			echo "Table Insert Nodes Successfully<br/> ";
		} else {
			echo "Error creating table: " .  mysqli_error($westyleSQL)."</br>";
		}
		
		$AdminGroup = M("AdminGroup");
		$mAdminGroup['title']='supervisor';
		$mAdminGroup['description']='超级管理员，请勿操作';
		$AdminNode = M("AdminNode");
		$admin_node_list = $AdminNode->order('id')->select();
		$rules = '';
		foreach ($admin_node_list as $key=>$value){
			$rules = $rules.",".$value['id'];
		}
		$rules=substr($rules, 1);
		$mAdminGroup['rules']=$rules;
		
		C('TOKEN_ON',false);
		if($AdminGroup->create($mAdminGroup)){
			$supervisor_id = $AdminGroup->add();
			echo "Insert admin group SUCCESS</br>";
		}else{
			echo $AdminUser->getError();
		}
		C('TOKEN_ON',true);
		
		$AdminUser = M("AdminUser");
		$mAdminUser['username']='admin';
		$mAdminUser['password']=md5('admin123');
		$mAdminUser['admin_group_id']=$supervisor_id;
		C('TOKEN_ON',false);
		if($AdminUser->create($mAdminUser)){
			$AdminUser->add();
			echo "Insert admin SUCCESS</br>";
		}else{
			echo $AdminUser->getError();
		}
		C('TOKEN_ON',true);
	}
}
