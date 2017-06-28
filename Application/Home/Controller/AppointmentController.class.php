<?php
namespace Home\Controller;
use Think\Controller;
/*
 *预约status说明：
 1：客户发送预约申请，未完成
 2：预约被确认，成功预约
 3：预约被使用，确认消费
 4: 预约成功但超时未使用
 5：预约被确认，预约失败
 -3：预约被使用后被客户删除
 -4: 成功但超时未使用被客户删除
 -5：失败后，已被客户删除预约
 */
class AppointmentController extends Controller {
    //订单列表页面
	public function index(){
			$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();
			$time = time();
			$VAppointmentImage = D("V_Appointment_Image");
			$Appointment = M("Appointment");
			$condition = array();
			$condition['customer_id']=$open_id;
			$condition['status']=array('gt',0);
			$appointment_base_list = $VAppointmentImage->field('id,type,item_id,name,img_path,time,adr,status')
				->where($condition)->order('time')->select();
			foreach ($appointment_base_list as $key => $value) {
				if(($value['status']==2)&&($time>$value['time'])){
					$value['status'] = 5;
					$Appointment->find($value['id']); //  查找主键为 1 的数据
					$Appointment->status = 5; //  修改数据对象
					$Appointment->save();
				}
				$appointment_list[] = $value; 
			}
			$this->assign("appointment_list",$appointment_list);
			$this->display();
    }
	
	//预约信页面，包含顾客的二维码和预约单号，扫码等同于扫描会员卡+更改预约状态
	public function letter($id){
			$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();
			$condition = array();
			$condition['customer_id']=$open_id;
			$condition['id']=$id;
			$VAppointmentImage = D("V_Appointment_Image");
			$appointment = $VAppointmentImage->field('id,type,item_id,name,img_path,time,adr')
				->where($condition)->select()[0];
			
			$Customer = M("Customer");
			$appointment['user'] = $Customer->where('open_id='.$open_id)->getField('username_en')[0];
			
			$appointment['map'] = getMap();
			
			$this->assign("appointment",$appointment);
			$this->display();
    }
	
	//删除预约
	public function delete(){
		if(!IS_AJAX){
			exit('页面不存在');
		}else{
			$Customer=M('Customer');
			$wechat = new \Common\Model\WechatModel();
			$open_id=$wechat->getOpenId();	
			$data = array();
			
			$Appointment = M("Appointment");
			$condition['id']=I('id');
			$condition['customer_id']=$open_id;
			
			$status = $Appointment->where($condition)->getField('status')[0];
			if($status>2){
				$Appointment->find($value['id']); //  查找主键为 1 的数据
				$Appointment->status = 0-$status; //  修改数据对象
				$Appointment->save();	
				
				$data['status'] = 1;  
				$data['info'] = '删除预约';  
				$data['url'] = U('Appointment/index');
			}else{
				$data['status'] = 0;  
				$data['info'] = '删除失败';  
				$data['url'] = U('Appointment/index');
			}
			
			$this->ajaxReturn($data);
		}
    }
	
	
	//添加预约
	public function add(){
	    if(!IS_AJAX){
			exit('页面不存在');
		}else{
			if(!empty(I('type')) && !empty(I('item_id'))){
				if(!empty(I('time'))){
					$appoint = array();
					$wechat = new \Common\Model\WechatModel();
					$open_id=$wechat->getOpenId();
					$Appointment=M('Appointment');
	
					$appoint=I('post.');//type,item_id,time
					$appoint['customer_id']=$open_id;
					$appoint['status']=1;
					$VItemImage = null;
					switch ($appoint['type']){
						case 1:
							$VItemImage = D("V_Shop_Image");break;  
						case 4:
							$VItemImage = D("V_Restaurant_Image");break;
						default:
							$data['status'] = 0;  
							$data['info'] = 'type错误';  
							$data['url'] = U('Appointment/index');  
							$this->ajaxReturn($data);
					}
					$condition['id']= $appoint['item_id'];
					$condition['img_sort']=1;
					$item = $VItemImage->field('img_id,name,adr')
						->where($condition)->select()[0];
					$appoint['img_id']=$item['img_id'];
					$appoint['name']=$item['name'];
					$appoint['adr']=$item['adr'];
	
					if($Appointment->create($appoint)){
						if($Appointment->add()){
							$data['status'] = 1;  
							$data['info'] = '请求已发送';  
							$data['url'] = U('Appointment/index');
						}else{
							$data['status'] = 0;  
							$data['info'] = '预约失败';  
							$data['url'] = U('Appointment/index');
						}
						//通过ajaxReturn()方法返回我们之前生成的数组  
						$this->ajaxReturn($data);
					}else{
						exit($Appointment->getError());
					}
				}else{
					$data['status'] = 0;  
					$data['info'] = '预约时间为空';  
					$data['url'] = U('Appointment/index');
					$this->ajaxReturn($data);
				}
								
			}else{
				$data['status'] = 0;  
				$data['info'] = '参数为空';  
				$data['url'] = U('Appointment/index');
				$this->ajaxReturn($data);
			}				
		}
    }
	
	
	
		
	//批量添加预约
	public function addAll(){
	    if(!IS_AJAX){
			exit('页面不存在');
		}else{
			if(!empty(I('time'))){
				$appoint = array();
				$wechat = new \Common\Model\WechatModel();
				$open_id=$wechat->getOpenId();
				$ids = I('ids');
				$Appointment=M('Appointment');
				$VItemImage = D("V_Shop_Image"); 

				foreach ($ids as $id){
					$condition['id']= $id;
					$condition['img_sort']=1;
					$item = $VItemImage->field('img_id,name,adr')
						->where($condition)->select()[0];
					$appoint['img_id']=$item['img_id'];
					$appoint['name']=$item['name'];
					$appoint['adr']=$item['adr'];
					$appoint['status']=1;
		
					if($Appointment->create($appoint)){
						if(!$Appointment->add()){
							$data['status'] = 0;  
							$data['info'] = '预约失败';  
							$data['url'] = U('Appointment/index');
							$this->ajaxReturn($data);
						}					
					}else{
						exit($Appointment->getError());
					}
				}
				$data['status'] = 1;  
				$data['info'] = '请求已发送';  
				$data['url'] = U('Appointment/index');
				$this->ajaxReturn($data);
			}else{
				$data['status'] = 0;  
				$data['info'] = '预约时间为空';  
				$data['url'] = U('Appointment/index');
				$this->ajaxReturn($data);
			}
		}				
	}
    
}