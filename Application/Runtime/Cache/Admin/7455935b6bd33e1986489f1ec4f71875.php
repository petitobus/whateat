<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Shop列表</title>
</head>
<body>
<script>
    function PhotoManeger(){
        alert("该功能尚在开发中")
    }
</script>
<div>
    <table border="1">
        <th colspan="20">Shop列表</th>
        <tr>
            <td>商店id</td>
            <td>商定名称</td>
            <td>商店地址</td>
            <td>联系电话</td>
            <td>商店传真</td>
            <td>商店邮箱</td>
            <td>邮编</td>
            <td>所属城市</td>
            <td>商圈</td>
            <td>银行端ID</td>
            <td colspan="3">
                <a href="create.shtml">
                    <input type="button" value="  添加  " style="background-color: orange">
                </a>
            </td>
        </tr>
        <?php if(is_array($shop_list)): $i = 0; $__LIST__ = $shop_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($shop["id"]); ?></td>
                <td><?php echo ($shop["name"]); ?></td>
                <td><?php echo ($shop["adr"]); ?></td>
                <td><?php echo ($shop["tel"]); ?></td>
                <td><?php echo ($shop["fax"]); ?></td>
                <td><?php echo ($shop["email"]); ?></td>
                <td><?php echo ($shop["area"]); ?></td>
                <td><?php echo ($shop["city_name"]); ?></td>
                <td><?php echo ($shop["commercial_area_name"]); ?></td>
                <td><?php echo ($shop["merchant_id"]); ?></td>
                <td colspan="4">
                    <a href="update.shtml?id=<?php echo ($shop["id"]); ?>">
                        <input type="button" value="修改">
                    </a>
                    <a href="post.shtml?method=delete&id=<?php echo ($shop["id"]); ?>">
                        <input type="button" value="删除">
                    </a>
                    <a href="detail.shtml?id=<?php echo ($shop["id"]); ?>">
                        <input type="button" value="详细">
                    </a>
                    <a  onclick='notify_url(name="<?php echo ($shop["name"]); ?>",mid="<?php echo ($shop["merchant_id"]); ?>")'>
						<input type="button" value="二维码URL">
                    </a>
					<a href="img_upload.shtml?id=<?php echo ($shop["id"]); ?>">
						<input type="button" value="图片管理">
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
</body>
</html>
<script>
function notify_url(name,mid) {
	host = window.location.host;
    url = "http://"+host+"/whateat/Exterior/Alipay/notify/merchant_id/"+name.replace(/[^a-zA-Z0-9]/g,"_")+"-"+mid;
    var name = prompt("请复制以下url", url);
}
</script>