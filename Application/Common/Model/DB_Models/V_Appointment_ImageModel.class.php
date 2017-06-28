<?php
namespace Common\Model;

use Common\Model\ViewModel;

class V_Appointment_ImageModel extends ViewModel{
    public $viewFields = array(
	'RAppointmentImage' => array('_on'=>'RAppointmentImage.appointment_id = Appointment.id', '_on'=>'RAppointmentImage.img_id = Image.img_id'),
	'Appointment' => array('id', 'type', 'item_id', 'name', 'time', 'adr'),
	'Image' => array('img_id', 'img_path'),
    );
}
