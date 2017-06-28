<?php
namespace Admin\Model;

use Think\Model\ViewModel;

//操作员
class VTradeVoucherModel extends ViewModel{
    public $viewFields = array(
	'VoucherTrade' => array('*'),
	'Voucher'=> array('voucher_name','voucher_code','commision', '_on'=>'Voucher._id=VoucherTrade.voucher_id'),
    );
}
