<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>上传商店图片</title>
</head>
<body>
<div>
    <form action="img_handler?id=<?php echo ($shop["id"]); ?>"  enctype="multipart/form-data" method="post">
        <table border="1">
            <th colspan="6">上传商店图片</th>
            <tr>
                <td>首页展示栏</td>
                <td><input type="file" name="img_index" /></td>
            </tr>
            <tr>
                <td>幻灯1</td>
                <td><input type="file" name="img_slide_1" /></td>
            </tr>
            <tr>
                <td>幻灯2</td>
                <td><input type="file" name="img_slide_2" /></td>
            </tr>
            <tr>
                <td>幻灯3</td>
                <td><input type="file" name="img_slide_3" /></td>
            </tr>
            <tr>
                <td>幻灯4</td>
                <td><input type="file" name="img_slide_4" /></td>
            </tr>
            <tr>
                <td>图标</td>
                <td><input type="file" name="img_icon" /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="         上传         " style="display: block;margin: 0 auto 0"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>