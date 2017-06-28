<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>nearby</title>
</head>
<?php
//现在位置信息及目的地信息

$lat1 = '48.851698';
$lng1 = '2.331339';
$lat2 = '48.846835';
$lng2 = '2.326501';
?>
<body>
<iframe width="600" height="450" frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/directions?origin=<?php echo $lat1?>,
            <?php echo $lng1?>&destination=<?php echo $lat2?>,<?php echo $lng2?>&key=AIzaSyBtZgnMMWw8xEwwzIOL43CBUnYrOpxjwIk"></iframe>
</body>
</html>