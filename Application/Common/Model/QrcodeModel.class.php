<?php
namespace Common\Model;

//关于二维码生成和读取的封装函数
class QrcodeModel{
    //url里为二维码转到的地址
    public function qrcode($url='http://www.baidu.com/',$level=3,$size=4){
        Vendor('phpqrcode.phpqrcode');
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        //生成二维码图片
        //echo $_SERVER['REQUEST_URI'];
        $object = new \QRcode();
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
    }
}
}  