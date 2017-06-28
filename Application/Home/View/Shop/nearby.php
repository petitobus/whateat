<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>nearby</title>
</head>
<?php
$name = 'kebab';
$dist = '1'
?>
<body>
<script language="JavaScript">
    //从小窗口打开路线图
    function openwin(){
        window.open("test2.php","newwindow","width=400,toolbar=0,menubar=no,scrollbars=no,resizable=no,location=no,status=no")
    }
</script>
<table width="80%">
    <tr>
        <th>附近商家</th>
        <th><a href="mapTest1.php">地图</a></th>
    </tr>
    <tr>
        <td><?php echo $name   ?></td>
        <td><?php echo $dist   ?>
            <a href="direction.php" onclick="openwin()">go</a></td>
        </td>
    </tr>
</table>
</body>
</html>