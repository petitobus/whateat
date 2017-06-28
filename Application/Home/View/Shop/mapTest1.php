<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>附近商家地图</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }
    </style>
</head>
<body>
<?php
//从微信定位获取现在的位置信息
$poslat = 48.851698;   //纬度
$poslng = 2.331339 ;   //精度

//数据库商家信息
$lat1 = '48.846835';
$lng1 = '2.326501';
$content1 = '任潇雨';   //content商家内容信息
$lat2='48.844866';
$lng2='2.328712';
$content2='shuai'

?>
<div id="map"></div>
<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: new google.maps.LatLng(<?php echo $poslat; ?>, <?php echo $poslng; ?>),
            zoomControl: false, //关闭放大缩小功能
            streetViewControl: false //关闭街景功能
        });
        //标记现在位置
        var currentpostion = new google.maps.Marker({
            position: map.getCenter(),
            icon: {
                //图标，可换成其他文件，后续可改，暂时用想下箭头
                path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                scale: 6
            },
            draggable: false,
            map: map
        });
    }
    function setMarker(){
        /**这里添加foreach结构，可重复添加多次标签
        下面content部分换位$marker[content]
            lat部分换位$marker[lat]
            lng部分换位$marker[lng]
        */
        creat('<?php echo $content1?>',<?php echo $lat1?>,<?php echo $lng1?>);
        creat('<?php echo $content2?>',<?php echo $lat2?>,<?php echo $lng2?>);
    }

    function creat(cont,lat,lng) {
        var contentString = cont;
        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 200
        });
        var marker = new google.maps.Marker({
            position: {lat:lat, lng:lng},
            map: map,
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
        // end foreach

    }

    function run() {
        initMap();
        setMarker();
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtZgnMMWw8xEwwzIOL43CBUnYrOpxjwIk&signed_in=true&callback=initMap&signed_in=true&callback=run"></script>
</body>
</html>