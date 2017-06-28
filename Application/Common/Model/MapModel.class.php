<?php
namespace Common\Model;

class MapModel{
	
/**
 * 获取指定经纬度附近的方形区域的经纬度界限。
 * @param mixed $lng 原始经度
 * @param mixed $lat 原始纬度
 * @param mixed $distance 附近距离
 * @return mixed 最小纬度，最大纬度，最小经度，最大经度
 */
	public function returnSquareLimit($lng, $lat,$distance = 0.5){
        $earthRadius = 6378138;
        $dlng =  2 * asin(sin($distance / (2 * $earthRadius)) / cos(deg2rad($lat)));
        $dlng = rad2deg($dlng);
        $dlat = $distance/$earthRadius;
        $dlat = rad2deg($dlat);
        return array(
			'latitude_min'=>($lat-$dlat),
			'latitude_max'=>($lat+$dlat),
			'longtitude_max'=>($lng+$dlng),
			'longtitude_max'=>($lng+$dlng)
        );
   }

/**
 * 获取两个坐标之间的直线距离。
 * @param mixed $lat1 经度1
 * @param mixed $lng1 纬度1
 * @param mixed $lat2 经度2
 * @param mixed $lng2 纬度2
 * @return mixed 距离
 */
	public function getDistance($lat1, $lng1, $lat2, $lng2){      
		$earthRadius = 6378138; //近似地球半径米
		// 转换为弧度
		$lat1 = ($lat1 * pi()) / 180;
		$lng1 = ($lng1 * pi()) / 180;
		$lat2 = ($lat2 * pi()) / 180;
		$lng2 = ($lng2 * pi()) / 180;
		// 使用半正矢公式  用尺规来计算
		$calcLongitude = $lng2 - $lng1;
		$calcLatitude = $lat2 - $lat1;
		$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  
		$stepTwo = 2 * asin(min(1, sqrt($stepOne)));
		$calculatedDistance = $earthRadius * $stepTwo;
		return round($calculatedDistance);
	}
	
	//TODO 生成导航所需要的url，需添加备注。。。
	function directionMap($position,$destination){
		//苹果手机打开地图app
		$url = "appleMap://map/direction?&origin={$position}&destination={$destination}";
		return 1;
	}
/**
 * geocode，把地理位置转换成经纬坐标	 
 * @param mixed $address 地址信息
 */
	public function geoCode($address){
		//转换url en code
		$address = urlencode($address);
		//调用google api
		$url = "http://maps.google.com/maps/api/geocode/json?address={$address}&key=AIzaSyBtZgnMMWw8xEwwzIOL43CBUnYrOpxjwIk";

		//获取json返回值
		$resp_json = file_get_contents($url);

	    $response = json_decode($resp_json, true);

		/*如果能夠進行地理編碼，則status为OK*/
		if($response['status']='OK'){
			//取得需要的重要資訊
			$latitude_data = $response['results'][0]['geometry']['location']['lat']; //纬度
			$longitude_data = $response['results'][0]['geometry']['location']['lng']; //精度
			$data_address = $response['results'][0]['formatted_address'];

			if($latitude_data && $longitude_data && $data_address){
				$data_array = array();					
				//一個或多個單元加入陣列末尾
				array_push(
					$data_array,
					$latitude_data, //$data_array[0]
					$longitude_data, //$data_array[1]
					$data_address //$data_array[2]
					);

					return $data_array; //回傳$data_array

				}else{
					return false;
				}

			}else{
				return false;
			}
        }
}  